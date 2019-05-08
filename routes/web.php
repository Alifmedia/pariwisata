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

// Akomodasi
Route::get('/akomodasi', 'AkomodasiDataController@index')->name('akomodasi');
Route::get('/akomodasi/create', 'AkomodasiDataController@create')->name('akomodasi.create');
Route::post('/akomodasi/create', 'AkomodasiDataController@save');
Route::get('/akomodasi/edit/{id}', 'AkomodasiDataController@edit')->name('akomodasi.edit');
Route::post('/akomodasi/edit', 'AkomodasiDataController@update')->name('akomodasi.update');
Route::post('/akomodasi/delete', 'AkomodasiDataController@delete')->name('akomodasi.delete');

Route::get('/akomodasi/hunian', 'AkomodasiHunianController@index')->name('akomodasi.hunian');

// Biro Perjalanan
Route::get('/biro-perjalanan', 'BiroPerjalananDataController@index')->name('biro_perjalanan');
Route::get('/biro-perjalanan/create', 'BiroPerjalananDataController@create')->name('biro_perjalanan.create');
Route::post('/biro-perjalanan/create', 'BiroPerjalananDataController@save');
Route::get('/biro-perjalanan/edit/{id}', 'BiroPerjalananDataController@edit')->name('biro_perjalanan.edit');
Route::post('/biro-perjalanan/edit', 'BiroPerjalananDataController@update')->name('biro_perjalanan.update');
Route::post('/biro-perjalanan/delete', 'BiroPerjalananDataController@delete')->name('biro_perjalanan.delete');
Route::post('/biro-perjalanan/foto/delete', 'BiroPerjalananDataController@deleteFoto')->name('biro_perjalanan.foto.delete');
Route::get('/biro-perjalanan/{id}', 'BiroPerjalananDataController@show')->name('biro_perjalanan.show');

Route::get('/biro-perjalanan/perizinan', 'BiroPerjalananDataController@perizinan')->name('biro_perjalanan.perizinan');

// Objek Wisata
Route::get('/objek-wisata', 'ObjekWisataDataController@index')->name('objek_wisata');
Route::get('/objek-wisata/create', 'ObjekWisataDataController@create')->name('objek_wisata.create');
Route::post('/objek-wisata/create', 'ObjekWisataDataController@save');
Route::get('/objek-wisata/edit/{id}', 'ObjekWisataDataController@edit')->name('objek_wisata.edit');
Route::post('/objek-wisata/edit', 'ObjekWisataDataController@update')->name('objek_wisata.update');
Route::post('/objek-wisata/delete', 'ObjekWisataDataController@delete')->name('objek_wisata.delete');
Route::post('/objek-wisata/foto/delete', 'ObjekWisataDataController@deleteFoto')->name('objek_wisata.foto.delete');
Route::get('/objek-wisata/{id}', 'ObjekWisataDataController@show')->name('objek_wisata.show');


// Ekonomi Kreatif
Route::get('/ekonomi-kreatif', 'EkonomiKreatifDataController@index')->name('ekonomi_kreatif');
Route::get('/ekonomi-kreatif/create', 'EkonomiKreatifDataController@create')->name('ekonomi_kreatif.create');
Route::post('/ekonomi-kreatif/create', 'EkonomiKreatifDataController@save');
Route::get('/ekonomi-kreatif/edit/{id}', 'EkonomiKreatifDataController@edit')->name('ekonomi_kreatif.edit');
Route::post('/ekonomi-kreatif/edit', 'EkonomiKreatifDataController@update')->name('ekonomi_kreatif.update');
Route::post('/ekonomi-kreatif/delete', 'EkonomiKreatifDataController@delete')->name('ekonomi_kreatif.delete');
Route::post('/ekonomi-kreatif/foto/delete', 'EkonomiKreatifDataController@deleteFoto')->name('ekonomi_kreatif.foto.delete');
Route::get('/ekonomi-kreatif/{id}', 'EkonomiKreatifDataController@show')->name('ekonomi_kreatif.show');

// Kuliner
Route::get('/kuliner', 'KulinerDataController@index')->name('kuliner');
Route::get('/kuliner/create', 'KulinerDataController@create')->name('kuliner.create');
Route::post('/kuliner/create', 'KulinerDataController@save');
Route::get('/kuliner/edit/{id}', 'KulinerDataController@edit')->name('kuliner.edit');
Route::post('/kuliner/edit', 'KulinerDataController@update')->name('kuliner.update');
Route::post('/kuliner/delete', 'KulinerDataController@delete')->name('kuliner.delete');
Route::post('/kuliner/foto/delete', 'KulinerDataController@deleteFoto')->name('kuliner.foto.delete');
Route::get('/kuliner/{id}', 'KulinerDataController@show')->name('kuliner.show');


// Pramuwisata
Route::get('/pramuwisata', 'PramuwisataDataController@index')->name('pramuwisata');
Route::get('/pramuwisata/create', 'PramuwisataDataController@create')->name('pramuwisata.create');
Route::post('/pramuwisata/create', 'PramuwisataDataController@save');
Route::get('/pramuwisata/edit/{id}', 'PramuwisataDataController@edit')->name('pramuwisata.edit');
Route::post('/pramuwisata/edit', 'PramuwisataDataController@update')->name('pramuwisata.update');
Route::post('/pramuwisata/delete', 'PramuwisataDataController@delete')->name('pramuwisata.delete');
Route::post('/pramuwisata/foto/delete', 'PramuwisataDataController@deleteFoto')->name('pramuwisata.foto.delete');
Route::get('/pramuwisata/{id}', 'PramuwisataDataController@show')->name('pramuwisata.show');

// Sanggar Wisata
Route::get('/sanggar-seni', 'SanggarSeniDataController@index')->name('sanggar_seni');
Route::get('/sanggar-seni/create', 'SanggarSeniDataController@create')->name('sanggar_seni.create');
Route::post('/sanggar-seni/create', 'SanggarSeniDataController@save');
Route::get('/sanggar-seni/edit/{id}', 'SanggarSeniDataController@edit')->name('sanggar_seni.edit');
Route::post('/sanggar-seni/edit', 'SanggarSeniDataController@update')->name('sanggar_seni.update');
Route::post('/sanggar-seni/delete', 'SanggarSeniDataController@delete')->name('sanggar_seni.delete');
Route::post('/sanggar-seni/foto/delete', 'SanggarSeniDataController@deleteFoto')->name('sanggar_seni.foto.delete');
Route::get('/sanggar-seni/{id}', 'SanggarSeniDataController@show')->name('sanggar_seni.show');

// Transportasi
Route::get('/transportasi', 'TransportasiDataController@index')->name('transportasi');
Route::get('/transportasi/create', 'TransportasiDataController@create')->name('transportasi.create');
Route::post('/transportasi/create', 'TransportasiDataController@save');
Route::get('/transportasi/edit/{id}', 'TransportasiDataController@edit')->name('transportasi.edit');
Route::post('/transportasi/edit', 'TransportasiDataController@update')->name('transportasi.update');
Route::post('/transportasi/delete', 'TransportasiDataController@delete')->name('transportasi.delete');
Route::post('/transportasi/foto/delete', 'TransportasiDataController@deleteFoto')->name('transportasi.foto.delete');
Route::get('/transportasi/{id}', 'TransportasiDataController@show')->name('transportasi.show');

// Transportasi
Route::get('/money-changer', 'MoneyChangerDataController@index')->name('money_changer');
Route::get('/money-changer/create', 'MoneyChangerDataController@create')->name('money_changer.create');
Route::post('/money-changer/create', 'MoneyChangerDataController@save');
Route::get('/money-changer/edit/{id}', 'MoneyChangerDataController@edit')->name('money_changer.edit');
Route::post('/money-changer/edit', 'MoneyChangerDataController@update')->name('money_changer.update');
Route::post('/money-changer/delete', 'MoneyChangerDataController@delete')->name('money_changer.delete');
Route::post('/money-changer/foto/delete', 'MoneyChangerDataController@deleteFoto')->name('money_changer.foto.delete');
Route::get('/money-changer/{id}', 'MoneyChangerDataController@show')->name('money_changer.show');


Route::get('/souvenir', function () {
  return view('soon');
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
