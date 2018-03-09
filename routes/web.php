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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('produks', 'ProdukController');

Route::resource('pemesanans', 'PemesananController');

Route::get('pemesanan/{id}/detail', 'DetailController@index')->name('detailPemesanan');
Route::get('pemesanan/{id}/detail/create', 'DetailController@create')->name('createPesanan');
Route::post('pemesanan/{id}/detail/store', 'DetailController@store')->name('storePesanan');
Route::post('pemesanan/{id}/detail/destroy', 'DetailController@destroy')->name('destroyPesanan');


Route::resource('produks', 'ProdukController');

Route::resource('jabatans', 'JabatanController');



Route::resource('supirs', 'SupirController');

Route::resource('pemesanans', 'PemesananController');

Route::resource('produksis', 'ProduksiController');

Route::resource('pengiriman', 'PengirimanController');

Route::resource('bahanBakus', 'BahanBakuController');

Route::resource('pengadaans', 'PengadaanController');

Route::resource('opnames', 'OpnameController');


Route::resource('pengirimen', 'PengirimanController');
