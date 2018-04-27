<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\Produk;
use App\Models\Kendaraan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = [
          '1' => 'StandBy',
          '2' => 'Rusak',
          '3' => 'Rental'
        ];

        $bahanBaku = BahanBaku::all();
        $produks = Produk::all();
        $kendaraans = Kendaraan::all();
        $title = "Beranda";
        return view('home')
              ->with('bahanBakus', $bahanBaku)
              ->with('produks', $produks)
              ->with('title', $title)
              ->with('kendaraans', $kendaraans)
              ->with('status', $status);
    }
}
