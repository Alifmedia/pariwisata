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


Route::get('/akomodasi', 'AkomodasiDataController@index')->name('akomodasi');
Route::get('/akomodasi/kunjungan', 'AkomodasiDataController@kunjungan')->name('akomodasi.kunjungan');

Route::get('/biro-perjalanan', 'BiroPerjalananDataController@index')->name('biro_perjalanan');
Route::get('/biro-perjalanan/perizinan', 'BiroPerjalananDataController@perizinan')->name('biro_perjalanan.perizinan');

Route::get('/objek-wisata', 'ObjekWisataDataController@index')->name('objek_wisata');

Route::get('/ekonomi-kreatif', 'EkonomiKreatifDataController@index')->name('ekonomi_kratif');

Route::get('/kuliner', 'KulinerDataController@index')->name('kuliner');


Route::get('/akomodasi/tambah-data-akomodasi', function () {
  return view('akomodasi_add_data');
})->name('akomodasi.tambah_data');

Route::get('/transportasi', function () {
  return view('transportasi');
})->name('transportasi');


Route::get('/souvenir', function () {
  return view('souvenir');
})->name('souvenir');

Route::get('/', function () {
    return view('login');
});

// Auth::routes();

// Authentication Routes...
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('akun-baru', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('akun-baru', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
