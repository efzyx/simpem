<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\Produk;

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
        $bahanBaku = BahanBaku::all();
        $produks = Produk::all();
        $title = "Application";
        return view('home')
              ->with('bahanBakus', $bahanBaku)
              ->with('produks', $produks)
              ->with('title', $title);
    }
}
