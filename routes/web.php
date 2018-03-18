<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');

    Route::resource('produks', 'ProdukController');

    Route::resource('jabatans', 'JabatanController');

    Route::resource('supirs', 'SupirController');

    Route::get('pemesanans/downloadPdf', 'PemesananController@downloadPdf')->name('downloadPdf');
    Route::resource('pemesanans', 'PemesananController');
    Route::resource('pemesanans.produksis', 'Pemesanan\ProduksiController');
    Route::resource('pemesanans.produksis.pengiriman', 'Pemesanan\Produksi\PengirimanController');

    Route::resource('produksis', 'ProduksiController');

    Route::resource('pengiriman', 'PengirimanController');

    Route::resource('bahanBakus', 'BahanBakuController');

    Route::resource('pengadaans', 'PengadaanController');

    Route::resource('opnames', 'OpnameController');

    Route::resource('users', 'UserController');

    Route::resource('bahanBakuHistories', 'BahanBakuHistoryController');

    Route::resource('komposisiMutus', 'KomposisiMutuController');

    Route::resource('kendaraans', 'KendaraanController');

    Route::resource('kendaraans.kendaraanDetails', 'KendaraanDetailController');
});
