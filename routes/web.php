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


Route::get('/akomodasi', function () {
  return view('akomodasi');
})->name('akomodasi');

Route::get('/transportasi', function () {
  return view('transportasi');
})->name('transportasi');

Route::get('/objek-wisata', function () {
  return view('objek_wisata');
})->name('objek_wisata');

Route::get('/kuliner', function () {
  return view('kuliner');
})->name('kuliner');

Route::get('/souvenir', function () {
  return view('souvenir');
})->name('souvenir');

Route::get('/', function () {
    return view('login');
});
