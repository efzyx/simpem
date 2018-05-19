<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProduksiRequest;
use App\Http\Requests\UpdateProduksiRequest;
use App\Repositories\ProduksiRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Pemesanan;
use App\Models\Supir;
use Auth;
use PDF;
use Carbon\Carbon;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\DB;
use App\Models\BahanBaku;
use App\Models\BahanBakuHistory;
use App\Models\Produksi;
use App\Models\Produk;
use App\Models\KomposisiMutu;
use App\Models\KendaraanDetail;

class ProduksiController extends AppBaseController
{
    /** @var  ProduksiRepository */
    private $produksiRepository;

    public function __construct(ProduksiRepository $produksiRepo)
    {
        $this->produksiRepository = $produksiRepo;
        $this->pemesanans = Pemesanan::orderBy('id', 'desc')->pluck('nama_pemesanan', 'id');
        $this->supirs = Supir::pluck('nama_supir', 'id');
        $this->kendaraans = Kendaraan::select(DB::raw("concat(no_polisi, ' - ', jenis_kendaraan) as nama"), 'id')->get();

        $this->kendaraans = $this->kendaraans->filter(function ($k) {
            return $k->lastStatus()->status == 1;
        })->pluck('nama', 'id');

        $this->produk = Produk::pluck('mutu_produk', 'id');
        $this->middleware('role:admin,marketing,produksi,manager_produksi')
                          ->only('index', 'show');
        $this->middleware('role:produksi')->except('index', 'show');
    }

    /**
     * Display a listing of the Produksi.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->produksiRepository->pushCriteria(new RequestCriteria($request));
        $produksis = $this->produksiRepository->all();
        $title = "Produksi";

        return view('produksis.index')
              ->with('produksis', $produksis)
              ->with('kendaraans', $this->kendaraans)
              ->with('title', $title);
    }

    public function filter(Request $request)
    {
        $this->produksiRepository->pushCriteria(new RequestCriteria($request));
        $produksis = $this->produksiRepository->all();
        $produksis = $produksis->filter(function ($produksi) use ($request) {
            $dari = $request['tanggal_kirim_dari'] ? Carbon::parse($request['tanggal_kirim_dari']) : null;
            $sampai = $request['tanggal_kirim_sampai'] ? Carbon::parse($request['tanggal_kirim_sampai']) : null;
            if ($dari) {
                if ($sampai) {
                    return ($produksi->waktu_produksi >= $dari &&
                         $produksi->waktu_produksi < $sampai->addDays(1)) ||
                         ($produksi->waktu_produksi >= $dari &&
                         $produksi->waktu_produksi < $dari->addDays(1));
                }
                return $produksi->waktu_produksi >= $dari &&
                 $produksi->waktu_produksi < $dari->addDays(1);
            }

            return $produksi;
        });

        $title = 'Produksi - Filter';

        return view('produksis.index')
              ->with('produksis', $produksis)
              ->with('kendaraans', $this->kendaraans)
              ->with('title', $title);
    }

    /**
     * Show the form for creating a new Produksi.
     *
     * @return Response
     */
    public function create()
    {
        $title = "Produksi - Tambah";
        return view('produksis.create')
              ->with('pemesanans', $this->pemesanans)
              ->with('supirs', $this->supirs)
              ->with('kendaraans', $this->kendaraans)
              ->with('title', $title);
    }

    /**
     * Store a newly created Produksi in storage.
     *
     * @param CreateProduksiRequest $request
     *
     * @return Response
     */
    public function store(CreateProduksiRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $pemesanan = Pemesanan::find($input['pemesanan_id']);
        $kendaraan = Kendaraan::find($input['kendaraan_id']);
        $komposisi_mutus = $pemesanan->produk->komposisi_mutus;
        $status = $this->statusKendaraan($kendaraan, $input);

        if (is_object($status)) {
            return $status;
        }

        if ($status != 1) {
            Flash::error('Kendaraan '. $kendaraan->no_polisi.' sedang '.($status == 2 ? 'Rusak' : 'Dirental').'!');
            return redirect()->back()->withInput($input);
        }

        if (!$this->checkStock($komposisi_mutus, $input['volume'])) {
            return redirect()->back()->withInput($input);
        }

        if (!$komposisi_mutus->count()) {
            Flash::error('Komposisi produk ada yang belum diset');
            return redirect()->back()->withInput($input);
        }

        $produksi = $this->produksiRepository->create($input);

        foreach ($komposisi_mutus as $key => $komposisi) {
            $bahan_baku = BahanBaku::find($komposisi->bahan_baku_id);
            $bahan_baku->sisa -= $komposisi->volume * $input['volume'];
            $bahan_baku->update();

            $bahan_baku_history = new BahanBakuHistory();
            $bahan_baku_history->bahan_baku_id = $komposisi->bahan_baku_id;
            $bahan_baku_history->type = 0;
            $bahan_baku_history->produksi_id = $produksi->id;
            $bahan_baku_history->volume = $komposisi->volume * $input['volume'];
            $bahan_baku_history->total_sisa = $bahan_baku->sisa;
            $bahan_baku_history->save();
        }

        Flash::success('Produksi saved successfully.');

        return redirect(route('produksis.index'));
    }

    /**
     * Display the specified Produksi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $produksi = $this->produksiRepository->findWithoutFail($id);
        $title = "Produksi - Lihat";

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect(route('produksis.index'));
        }

        return view('produksis.show')->with('produksi', $produksi)->with('title', $title);
    }

    /**
     * Show the form for editing the specified Produksi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $produksi = $this->produksiRepository->findWithoutFail($id);
        $title = "Produksi - Edit";

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect(route('produksis.index'));
        }

        return view('produksis.edit')
              ->with('produksi', $produksi)
              ->with('pemesanans', $this->pemesanans)
              ->with('supirs', $this->supirs)
              ->with('kendaraans', $this->kendaraans)
              ->with('title', $title);
        ;
    }

    /**
     * Update the specified Produksi in storage.
     *
     * @param  int              $id
     * @param UpdateProduksiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProduksiRequest $request)
    {
        $produksi = $this->produksiRepository->findWithoutFail($id);
        $input = $request->all();

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect(route('produksis.index'));
        }
        $old_kendaraan = $produksi->kendaraan;
        $kendaraan = Kendaraan::find($input['kendaraan_id']);
        $status = $this->statusKendaraan($kendaraan, $input);

        if (is_object($status)) {
            return $status;
        }

        if ($status != 1 && $old_kendaraan->id != $kendaraan->id) {
            Flash::error('Kendaraan '. $kendaraan->no_polisi.' sedang '.($status == 2 ? 'Rusak' : 'Dirental').'!');
            return redirect()->back()->withInput($input);
        }

        $komposisi_mutus = $produksi->pemesanan->produk->komposisi_mutus;
        $old_volume = $produksi->volume;
        if (!$this->checkStock($komposisi_mutus, $input['volume'], $old_volume)) {
            return redirect()->back()->withInput($input);
        }

        if (!$komposisi_mutus->count()) {
            Flash::error('Komposisi produk ada yang belum diset');
            return redirect()->back()->withInput($input);
        }

        foreach ($komposisi_mutus as $key => $komposisi) {
            $bahan_baku = BahanBaku::find($komposisi->bahan_baku_id);
            $bahan_baku->sisa -= $komposisi->volume * ($input['volume'] - $old_volume);
            $bahan_baku->update();

            $bahan_baku_history = $bahan_baku->bahan_baku_histories->where('produksi_id', $produksi->id)->first();
            $bahan_baku_history->bahan_baku_id = $komposisi->bahan_baku_id;
            $bahan_baku_history->type = 0;
            $bahan_baku_history->produksi_id = $produksi->id;
            $bahan_baku_history->volume = $komposisi->volume * ($input['volume'] - $old_volume);
            $bahan_baku_history->total_sisa = $bahan_baku->sisa;
            $bahan_baku_history->update();
        }

        $produksi = $this->produksiRepository->update($input, $id);

        Flash::success('Produksi updated successfully.');

        return redirect(route('produksis.index'));
    }

    /**
     * Remove the specified Produksi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $produksi = $this->produksiRepository->findWithoutFail($id);

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect()->back();
        }

        $komposisi_mutus = $produksi->pemesanan->produk->komposisi_mutus;

        foreach ($komposisi_mutus as $key => $komposisi) {
            $bahan_baku = BahanBaku::find($komposisi->bahan_baku_id);
            $bahan_baku->sisa += $komposisi->volume * $produksi->volume;
            $bahan_baku->update();
        }

        $this->produksiRepository->delete($id);

        Flash::success('Produksi deleted successfully.');

        return redirect()->back();
    }

    private function checkStock($komposisi_mutus, $volume, $old = null)
    {
        foreach ($komposisi_mutus as $key => $komposisi) {
            $bahan_baku = BahanBaku::find($komposisi->bahan_baku_id);
            $sisa = $bahan_baku->sisa - ($komposisi->volume * ($volume - $old ?: 0));

            if ($sisa <= 0) {
                Flash::error('Stock bahan baku '.$bahan_baku->nama_bahan_baku.' tidak mencukupi untuk produksi ini');
                return false;
            }
        }
        return true;
    }

    private function statusKendaraan($kendaraan, $input)
    {
        $last_update = $kendaraan->lastStatus();

        if (!$last_update) {
            Flash::error('Status kendaraan '.$kendaraan->no_polisi.' belum diset');
            return redirect()->back()->withInput($input);
        }
        return $last_update->status;
    }

    public function downloadPdf(Request $request)
    {
        $data = json_decode($request['produksis'], true);
        $produksis = Produksi::hydrate($data);
        $produksis = $produksis->flatten();
        $user =  Auth::user()->name;
        $pdf = PDF::loadView('produksis.pdf', ['produksis' => $produksis,'user'=>$user]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('produksi_'.time().'.pdf');
    }
}
