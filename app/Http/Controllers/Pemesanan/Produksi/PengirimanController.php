<?php

namespace App\Http\Controllers\Pemesanan\Produksi;

use App\Http\Requests\CreatePengirimanRequest;
use App\Http\Requests\UpdatePengirimanRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\Pemesanan;
use App\Models\Produksi;
use App\Models\Pengiriman;

class PengirimanController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('role:admin,marketing,produksi,manager_produksi')
                        ->only('index');
        $this->middleware('role:produksi')->except('index');
    }

    public function index(Pemesanan $pemesanan, Produksi $produksi, Request $request)
    {
        $pengirimans = $produksi->pengirimans;
        $title = 'Pengiriman';

        return view('pengiriman.index')
            ->with('pengirimans', $pengirimans)
            ->with('produksi', $produksi)
            ->with('title', $title);
    }

    /**
     * Store a newly created Pengiriman in storage.
     *
     * @param CreatePengirimanRequest $request
     *
     * @return Response
     */
    public function store(Pemesanan $pemesanan, Produksi $produksi, CreatePengirimanRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $pengiriman = Pengiriman::create($input);

        if ($pengiriman->status == 2) {
            $pengiriman->produksi->kendaraan->kendaraanDetails()->create([
            'status' => 1,
            'waktu'  => $pengiriman->created_at
          ]);
        } else {
            $pengiriman->produksi->kendaraan->kendaraanDetails()->create([
            'status' => 3,
            'waktu'  => $pengiriman->created_at
          ]);
        }

        Flash::success('Pengiriman saved successfully.');

        return redirect()->back();
    }
}
