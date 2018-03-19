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

class ProduksiController extends AppBaseController
{
    public function __construct()
    {
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

        $produksi = Produksi::create($input);

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

        if (empty($produksi)) {
            Flash::error('Produksi not found');

            return redirect(route('pemesanans.produksis.index', $pemesanan));
        }

        $produksi->update($request->all());

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

        $produksi->delete();

        Flash::success('Produksi deleted successfully.');

        return redirect(route('produksis.index'));
    }
}
