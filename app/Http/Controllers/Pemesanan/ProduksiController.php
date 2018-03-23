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
use App\Models\Pengiriman;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\DB;
use App\Models\Produksi;
use App\Models\BahanBaku;
use App\Models\BahanBakuHistory;

class ProduksiController extends AppBaseController
{
    public function __construct()
    {
        $this->supirs = Supir::pluck('nama_supir', 'id');
        $this->kendaraans = Kendaraan::select(DB::raw("concat(no_polisi, ' - ', jenis_kendaraan) as nama"), 'id')
                          ->pluck('nama', 'id');
        $this->middleware('role:admin,marketing,produksi,manager_produksi')
                          ->only('index');
        $this->middleware('role:produksi')->except('index');
    }

    /**
     * Display a listing of the Produksi.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Pemesanan $pemesanan, Request $request)
    {
        return view('pemesanans.produksis.index')
            ->with('produksis', $pemesanan->produksis)
            ->with('pemesanan', $pemesanan)
            ->with('kendaraans', $this->kendaraans);
    }

    /**
     * Show the form for creating a new Produksi.
     *
     * @return Response
     */
    public function create(Pemesanan $pemesanan)
    {
        return view('pemesanans.produksis.create')
              ->with('pemesanan', $pemesanan)
              ->with('supirs', $this->supirs)
              ->with('kendaraans', $this->kendaraans);
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

        if (!$komposisi_mutus->count()) {
            Flash::error('Komposisi produk pemesanan belum diset');
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
            $bahan_baku_history->produksi_id = $produksi->id;
            $bahan_baku_history->volume = $komposisi->volume * $input['volume'];
            $bahan_baku_history->total_sisa = $bahan_baku->sisa;
            $bahan_baku_history->save();
        }

        $pengiriman = new Pengiriman();
        $pengiriman->produksi_id = $produksi->id;
        $pengiriman->status = 0;
        $pengiriman->user_id = Auth::user()->id;
        $pengiriman->save();

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

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect(route('produksis.index'));
        }

        return view('pemesanans.produksis.show')
              ->with('produksi', $produksi)
              ->with('pemesanan', $pemesanan);
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

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect(route('pemesanans.produksis.index', $pemesanan));
        }

        return view('pemesanans.produksis.edit')
              ->with('produksi', $produksi)
              ->with('pemesanan', $pemesanan)
              ->with('supirs', $this->supirs)
              ->with('kendaraans', $this->kendaraans);
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

        if (!$komposisi_mutus->count()) {
            Flash::error('Komposisi produk pemesanan belum diset');
            return redirect()->back();
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

            return redirect(route('pemesanans.produksis.index', $pemesanan));
        }

        $komposisi_mutus = $produksi->pemesanan->produk->komposisi_mutus;

        foreach ($komposisi_mutus as $key => $komposisi) {
            $bahan_baku = BahanBaku::find($komposisi->bahan_baku_id);
            $bahan_baku->sisa += $komposisi->volume * $produksi->volume;
            $bahan_baku->update();
        }

        $produksi->delete();

        Flash::success('Produksi deleted successfully.');

        return redirect(route('produksis.index'));
    }
}
