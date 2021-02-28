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

Route::get('/bengkel-favorit', 'ClientAreaController@bengkelFav')->middleware('auth');
Route::get('/fav/{id_bengkel}', 'ClientAreaController@addToFav')->middleware('auth');
Route::get('/unfav/{id_bengkel}', 'ClientAreaController@deleteFav')->middleware('auth');
