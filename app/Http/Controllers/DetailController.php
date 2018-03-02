<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Produk;
use \App\DetailPemesanan;

class DetailController extends Controller
{
    public function index(Request $request)
    {
        $pemesanan_id = $request->id;
        $details = DetailPemesanan::where('pemesanan_id', '=', $pemesanan_id)->get();
        $produks = Produk::all()->pluck('nama_produk', 'id');
        $produkCollection = Produk::all();

        return view('detail.index')
        ->with('pemesanan_id', $pemesanan_id)
        ->with('produks', $produks)
        ->with('produk_pesan', $details)
        ->with('produkCollection', $produkCollection);
    }

    public function create(Request $request)
    {
        $pemesanan_id = $request->id;
        return view('detail.create')->with('pemesanan_id', $pemesanan_id);
    }

    public function store(Request $request)
    {
        // dd($request);
        $detail = new DetailPemesanan();
        $detail->pemesanan_id = $request->pemesanan_id;
        $detail->produk_id = $request->produk_id;
        // dd($detail->produk_id);
        $detail->quantity = $request->quantity;
        if ($detail->save()) {
            return redirect()->route('detailPemesanan', $request->pemesanan_id);
        } else {
            return \App::make('redirect')->back();
        }
    }
}
