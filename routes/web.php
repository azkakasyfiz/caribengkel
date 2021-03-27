<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/registeradmin', 'HomeController@registeradmin');
Route::post('/registadmin', 'HomeController@registadmin');

Route::get('/registerbengkel', 'HomeController@registerbengkel');
Route::post('/registbengkel', 'HomeController@registbengkel');




Route::get('/bengkel/{id}', 'BengkelController@show');

Route::get('/cari-bengkel/mobil', 'CariBengkelController@mobil');
Route::get('/cari-bengkel/mobil/jakarta-timur', 'CariBengkelController@daerahMobil');
Route::get('/cari-bengkel/mobil/jakarta-barat', 'CariBengkelController@daerahMobil');
Route::get('/cari-bengkel/mobil/jakarta-selatan', 'CariBengkelController@daerahMobil');
Route::get('/cari-bengkel/mobil/jakarta-utara', 'CariBengkelController@daerahMobil');
Route::get('/cari-bengkel/mobil/jakarta-pusat', 'CariBengkelController@daerahMobil');

Route::get('/cari-bengkel/motor', 'CariBengkelController@motor');
Route::get('/cari-bengkel/motor/jakarta-timur', 'CariBengkelController@daerahMotor');
Route::get('/cari-bengkel/motor/jakarta-barat', 'CariBengkelController@daerahMotor');
Route::get('/cari-bengkel/motor/jakarta-selatan', 'CariBengkelController@daerahMotor');
Route::get('/cari-bengkel/motor/jakarta-utara', 'CariBengkelController@daerahMotor');
Route::get('/cari-bengkel/motor/jakarta-pusat', 'CariBengkelController@daerahMotor');




Route::get('/search/bengkel', 'SearchController@bengkel');
Route::get('/search/bengkel/jakarta-timur', 'SearchController@bengkelJaktim');
Route::get('/search/bengkel/jakarta-barat', 'SearchController@bengkelJakbar');
Route::get('/search/bengkel/jakarta-selatan', 'SearchController@bengkelJaksel');
Route::get('/search/bengkel/jakarta-pusat', 'SearchController@bengkelJakpus');
Route::get('/search/bengkel/jakarta-utara', 'SearchController@bengkelJakut');
Route::get('/search/sparepart', 'SearchController@sparepart');

Route::post('/discuss', 'DiscussionController@submitDiscussion')->middleware('auth');
Route::post('/discuss/reply', 'DiscussionController@submitReply')->middleware('auth');

//client are
Route::get('/wishlist', 'ClientAreaController@wishlist')->middleware('auth');
Route::get('/wish/{id_product}', 'ClientAreaController@addWishlist')->middleware('auth');
Route::get('/unwish/{id_product}', 'ClientAreaController@deleteWishlist')->middleware('auth');

Route::get('/keranjang', 'ClientAreaController@keranjang')->middleware('auth');
Route::get('/cart/{id_product}', 'ClientAreaController@addKeranjang')->middleware('auth');
Route::get('/cart/{id_product}/plus', 'ClientAreaController@addPlusKeranjang')->middleware('auth');
Route::get('/cart/{id_product}/minus', 'ClientAreaController@addMinusKeranjang')->middleware('auth');
Route::get('/uncart/{id_product}', 'ClientAreaController@deleteKeranjang')->middleware('auth');
Route::get('/keranjang/checkout/{id_product}', 'ClientAreaController@checkout')->middleware('auth');

Route::get('/bengkel-favorit', 'ClientAreaController@bengkelFav')->middleware('auth');
Route::get('/fav/{id_bengkel}', 'ClientAreaController@addToFav')->middleware('auth');
Route::get('/unfav/{id_bengkel}', 'ClientAreaController@deleteFav')->middleware('auth');

Route::get('/pesantowing', 'TowingController@pesanTowing')->middleware('auth');
Route::post('/pesantowing/input', 'TowingController@addPesananTowing')->middleware('auth');
Route::get('/pesantowing/berhasil', 'TowingController@checkoutTowing')->middleware('auth');
Route::get('/statustowing', 'TowingController@statusTowing')->middleware('auth');



Route::group(['middleware' => ['cekrole:admin']], function (){
    Route::get('/admin', 'HomeController@admin');
    Route::post('/admin/inputproduct', 'ClientAreaController@AddBengkelProduct');



    Route::get('/inputspecialties', 'HomeController@formSpecialties');
    Route::post('/inputspecialties/add', 'ClientAreaController@addBengkelSpecialties');

    Route::get('/dashboard', 'HomeController@dashboard_admin');
    Route::get('/deleteproduct/{id_product}', 'HomeController@deleteProduct');
    Route::get('/listpesanan', 'HomeController@listPesanan');
});

Route::group(['middleware' => ['cekrole:towing']], function (){
    Route::get('/admintowing', 'TowingController@adminTowing');
    Route::get('/admintowing/acc/{id}', 'TowingController@accTowing');
    Route::get('/admintowing/dec/{id}', 'TowingController@decTowing');
    Route::get('/admintowing/pay/{id}', 'TowingController@payTowing');
});