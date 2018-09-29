<?php

namespace App\Http\Controllers\Pemesanan;

use App\Http\Requests\CreateProduksiRequest;
use App\Http\Requests\UpdateProduksiRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Pemesanan;
use App\Models\Supir;
use Auth;
use PDF;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\DB;
use App\Models\Produksi;
use App\Models\BahanBaku;
use App\Models\BahanBakuHistory;
use Carbon\Carbon;
use Excel;

class ProduksiController extends AppBaseController
{
    public function __construct()
    {
        $this->supirs = Supir::pluck('nama_supir', 'id');
        $this->kendaraans = Kendaraan::select(DB::raw("concat(no_polisi, ' - ', jenis_kendaraan) as nama"), 'id')->get();

        $this->kendaraans = $this->kendaraans->filter(function ($k) {
            if($k->lastStatus()){
                return $k->lastStatus()->status == 1;
            }
        })->pluck('nama', 'id');

        $this->middleware('role:admin,marketing,produksi,manager_produksi')
                          ->only('index', 'show', 'filter', 'downloadPdf');
        $this->middleware('role:produksi,manager_produksi,admin')->except('index', 'show', 'filter', 'downloadPdf');
    }

    /**
     * Display a listing of the Produksi.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Pemesanan $pemesanan, Request $request)
    {
        $title = 'Produksi';
        return view('pemesanans.produksis.index')
            ->with('produksis', $pemesanan->produksis()->orderBy('waktu_produksi', 'desc')->get())
            ->with('pemesanan', $pemesanan)
            ->with('kendaraans', $this->kendaraans)
            ->with('title', $title);
    }

    public function filter(Pemesanan $pemesanan, Request $request)
    {
        $produksis = $pemesanan->produksis()->orderBy('waktu_produksi', 'desc')->get();
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

        return view('pemesanans.produksis.index')
              ->with('produksis', $produksis)
              ->with('kendaraans', $this->kendaraans)
              ->with('title', $title)
              ->with('pemesanan', $pemesanan);
    }

    /**
     * Show the form for creating a new Produksi.
     *
     * @return Response
     */
    public function create(Pemesanan $pemesanan)
    {
        $title = 'Produksi - Tambah';
        return view('pemesanans.produksis.create')
              ->with('pemesanan', $pemesanan)
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
    public function store(Pemesanan $pemesanan, CreateProduksiRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $komposisi_mutus = $pemesanan->produk->komposisi_mutus;

        if (!$this->checkStock($komposisi_mutus, $input['volume'])) {
            return redirect()->back()->withInput($input);
        }

        if (!$komposisi_mutus->count()) {
            Flash::error('Komposisi produk ada yang belum diset');
            return redirect()->back()->withInput($input);
        }

        $produksi = Produksi::create($input);

        foreach ($komposisi_mutus as $key => $komposisi) {
            $bahan_baku = BahanBaku::find($komposisi->bahan_baku_id);
            $bahan_baku->sisa -= $komposisi->volume * $input['volume'];
            $bahan_baku->update();

            $bahan_baku_history = new BahanBakuHistory();
            $bahan_baku_history->bahan_baku_id = $komposisi->bahan_baku_id;
            $bahan_baku_history->type = 0;
            $bahan_baku_history->waktu = $produksi->waktu_produksi;
            $bahan_baku_history->produksi_id = $produksi->id;
            $bahan_baku_history->volume = $komposisi->volume * $input['volume'];
            $bahan_baku_history->total_sisa = $bahan_baku->sisa;
            $bahan_baku_history->save();
        }

        Flash::success('Produksi saved successfully.');

        return redirect(route('pemesanans.produksis.index', $pemesanan));
    }

    /**
     * Display the specified Produksi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Pemesanan $pemesanan, $id)
    {
        $produksi = Produksi::find($id);
        $title = 'Produksi - Lihat';

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect(route('produksis.index'));
        }

        return view('pemesanans.produksis.show')
              ->with('produksi', $produksi)
              ->with('pemesanan', $pemesanan)
              ->with('title', $title);
    }

    /**
     * Show the form for editing the specified Produksi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Pemesanan $pemesanan, $id)
    {
        $produksi = Produksi::find($id);
        $title = 'Produksi - Edit';

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect(route('pemesanans.produksis.index', $pemesanan));
        }

        return view('pemesanans.produksis.edit')
              ->with('produksi', $produksi)
              ->with('pemesanan', $pemesanan)
              ->with('supirs', $this->supirs)
              ->with('kendaraans', $this->kendaraans)
              ->with('title', $title);
    }

    /**
     * Update the specified Produksi in storage.
     *
     * @param  int              $id
     * @param UpdateProduksiRequest $request
     *
     * @return Response
     */
    public function update(Pemesanan $pemesanan, $id, UpdateProduksiRequest $request)
    {
        $produksi = Produksi::find($id);
        $input = $request->all();
        $komposisi_mutus = $pemesanan->produk->komposisi_mutus;

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect(route('pemesanans.produksis.index', $pemesanan));
        }

        $old_volume = $produksi->volume;

        if (!$this->checkStock($komposisi_mutus, $input['volume'], $old_volume)) {
            return redirect()->back()->withInput($input);
        }

        if (!$komposisi_mutus->count()) {
            Flash::error('Komposisi produk ada yang belum diset');
            return redirect()->back();
        }

        foreach ($komposisi_mutus as $key => $komposisi) {
            $bahan_baku = BahanBaku::find($komposisi->bahan_baku_id);
            $bahan_baku->sisa -= $komposisi->volume * ($input['volume'] - $old_volume);
            $bahan_baku->update();

            $bahan_baku_history = $bahan_baku->bahan_baku_histories->where('produksi_id', $produksi->id)->first();
            $bahan_baku_history->bahan_baku_id = $komposisi->bahan_baku_id;
            $bahan_baku_history->type = 0;
            $bahan_baku_history->waktu = $produksi->waktu_produksi;
            $bahan_baku_history->produksi_id = $produksi->id;
            $bahan_baku_history->volume = $komposisi->volume * ($input['volume'] - $old_volume);
            $bahan_baku_history->total_sisa = $bahan_baku->sisa;
            $bahan_baku_history->update();
        }


        $produksi->update($input);

        Flash::success('Produksi updated successfully.');

        return redirect(route('pemesanans.produksis.index', $pemesanan));
    }

    /**
     * Remove the specified Produksi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(Pemesanan $pemesanan, $id)
    {
        $produksi = Produksi::find($id);

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

        $produksi->delete();

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

    public function downloadPdf(Request $request)
    {
        $data = array(json_decode($request['pemesanans'], true));
        $pemesanans = Pemesanan::hydrate($data);
        $pemesanans = $pemesanans->flatten();
        $user =  Auth::user()->name;
        $pdf = PDF::loadView('pemesanans.produksis.pdf', ['pemesanans' => $pemesanans,'user' => $user, 'kendaraans' => $this->kendaraans]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('pengiriman_'.time().'.pdf');
    }

    public function exportExcel(Request $request)
    {
        set_time_limit(0); ini_set('memory_limit', '1G'); 
        $data = array(json_decode($request['pemesanans'], true));
        $pemesanans = Pemesanan::hydrate($data);
        $pemesanans = $pemesanans->flatten();
        $user =  Auth::user()->name;
        $filename = 'Rekapitulasi-Produksi-'.time();

        return Excel::create($filename , function($excel) use($pemesanans, $user, $filename) {
            $excel->sheet('Rekapitulasi', function($sheet) use ($pemesanans, $user) {
                $sheet->loadView('pemesanans.produksis.xls',compact('pemesanans','user'));
                $sheet->mergeCells('A1:F1');
            }, [
                'Content-Type' => 'application/vnd.ms-excel',
                'Content-Disposition' => "attachment; filename='".$filename.".xls'"
            ]);
        })->download();
    }
}
