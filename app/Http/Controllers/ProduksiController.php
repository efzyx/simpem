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
use App\Models\Pengiriman;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\DB;
use App\Models\BahanBaku;
use App\Models\BahanBakuHistory;
use App\Models\KomposisiMutu;

class ProduksiController extends AppBaseController
{
    /** @var  ProduksiRepository */
    private $produksiRepository;

    public function __construct(ProduksiRepository $produksiRepo)
    {
        $this->produksiRepository = $produksiRepo;
        $this->pemesanans = Pemesanan::pluck('nama_pemesanan', 'id');
        $this->supirs = Supir::pluck('nama_supir', 'id');
        $this->kendaraans = Kendaraan::select(DB::raw("concat(jenis_kendaraan, ' - ', no_polisi) as nama"), 'id')
                          ->pluck('nama', 'id');
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
        $produksis = $this->produksiRepository->simplePaginate(10);

        return view('produksis.index')
            ->with('produksis', $produksis);
    }

    /**
     * Show the form for creating a new Produksi.
     *
     * @return Response
     */
    public function create()
    {
        return view('produksis.create')
              ->with('pemesanans', $this->pemesanans)
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
    public function store(CreateProduksiRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $pemesanan = Pemesanan::find($input['pemesanan_id']);
        $komposisi_mutus = $pemesanan->produk->komposisi_mutus;

        if (!$komposisi_mutus->count()) {
          Flash::error('Komposisi produk pemesanan belum diset');
          return redirect()->back()->withInput($input);
        }

        $produksi = $this->produksiRepository->create($input);

        foreach ($komposisi_mutus as $key => $komposisi) {
          $bahan_baku = BahanBaku::find($komposisi->bahan_baku_id);
          $bahan_baku->sisa -= $komposisi->volume * $produksi->volume;
          $bahan_baku->update();

          $bahan_baku_history = new BahanBakuHistory();
          $bahan_baku_history->bahan_baku_id = $komposisi->bahan_baku_id;
          $bahan_baku_history->type = 0;
          $bahan_baku_history->produksi_id = $produksi->id;
          $bahan_baku_history->volume = $komposisi->volume * $produksi->volume;
          $bahan_baku_history->total_sisa = $bahan_baku->sisa;
          $bahan_baku_history->save();
        }

        $pengiriman = new Pengiriman();
        $pengiriman->produksi_id = $produksi->id;
        $pengiriman->status = 0;
        $pengiriman->user_id = Auth::user()->id;
        $pengiriman->save();

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

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect(route('produksis.index'));
        }

        return view('produksis.show')->with('produksi', $produksi);
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

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect(route('produksis.index'));
        }

        return view('produksis.edit')
              ->with('produksi', $produksi)
              ->with('pemesanans', $this->pemesanans)
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
    public function update($id, UpdateProduksiRequest $request)
    {
        $produksi = $this->produksiRepository->findWithoutFail($id);

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect(route('produksis.index'));
        }

        $produksi = $this->produksiRepository->update($request->all(), $id);

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

            return redirect(route('produksis.index'));
        }

        $this->produksiRepository->delete($id);

        Flash::success('Produksi deleted successfully.');

        return redirect(route('produksis.index'));
    }
}
