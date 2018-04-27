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

    Route::post('pemesanans/downloadPdf', 'PemesananController@downloadPdf')->name('downloadPdf');
    Route::post('pemesanans/filter', 'PemesananController@filter')->name('pemesanans.filter');

    Route::post('produksis/downloadPdf', 'ProduksiController@downloadPdf')->name('downloadProduksiPdf');
    Route::post('produksis/filter', 'ProduksiController@filter')->name('produksis.filter');

    Route::resource('pemesanans', 'PemesananController');
    Route::resource('pemesanans.produksis', 'Pemesanan\ProduksiController');
    Route::post('pemesanans.produksis/downloadPdf', 'Pemesanan\ProduksiController@downloadPdf')->name('downloadPengiriman');
    Route::resource('pemesanans.produksis.pengiriman', 'Pemesanan\Produksi\PengirimanController');

    Route::resource('produksis', 'ProduksiController');

    Route::resource('pengiriman', 'PengirimanController');

    Route::resource('bahanBakus', 'BahanBakuController');

    Route::resource('pengadaans', 'PengadaanController');

    Route::resource('opnames', 'OpnameController');

    Route::resource('users', 'UserController');

    Route::resource('bahanBakuHistories', 'BahanBakuHistoryController');

    Route::post('bahanBakuHistories/filter', 'BahanBakuHistoryController@filter')->name('filterHistoryBahanBaku');

    Route::resource('komposisiMutus', 'KomposisiMutuController');

    Route::resource('kendaraans', 'KendaraanController');

    Route::resource('kendaraans.kendaraanDetails', 'KendaraanDetailController');

    Route::resource('batasPengadaans', 'BatasPengadaanController');

    Route::resource('supplier', 'PemesananBahanBakuController');

    Route::post('supplier/downloadPDF', 'PemesananBahanBakuController@downloadPdf')->name('downloadSupplier');

    Route::post('supplier/filter', 'PemesananBahanBakuController@filter')->name('filterPesanBahanBaku');

    Route::resource('supplier.pengadaans', 'Supplier\PengadaanController');

    Route::post('supplier.pengadaans/downloadPdf', 'Supplier\PengadaanController@downloadPdf')->name('downloadPengadaan');
});
