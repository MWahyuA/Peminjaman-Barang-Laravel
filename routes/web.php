<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('user', 'App\Http\Controllers\UserController@index')->name('user.index');

Route::get('user/create', 'App\Http\Controllers\UserController@create')->name('user.create');

Route::post('user/store', 'App\Http\Controllers\UserController@store')->name('user.store');

Route::get('user/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');

Route::post('user/update/{id}', 'App\Http\Controllers\UserController@update')->name('user.update');

Route::post('user/destroy/{id}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');

Route::get('data_peminjam', 'App\Http\Controllers\DataPeminjamController@index')->name('data_peminjam.index');

Route::get('data_peminjam/create', 'App\Http\Controllers\DataPeminjamController@create')->name('data_peminjam.create');

Route::post('data_peminjam/store', 'App\Http\Controllers\DataPeminjamController@store')->name('data_peminjam.store');

Route::get('data_peminjam/edit{id}', 'App\Http\Controllers\DataPeminjamController@edit')->name('data_peminjam.edit');

Route::post('data_peminjam/update{id}', 'App\Http\Controllers\DataPeminjamController@update')->name('data_peminjam.update');

Route::post('data_peminjam/delete{id}', 'App\Http\Controllers\DataPeminjamController@destroy')->name('data_peminjam.destroy');

Route::get('data_vendor', 'App\Http\Controllers\DataVendorController@index')->name('data_vendor.index');

Route::get('data_vendor/create', 'App\Http\Controllers\DataVendorController@create')->name('data_vendor.create');

Route::post('data_vendor/store', 'App\Http\Controllers\DataVendorController@store')->name('data_vendor.store');

Route::get('data_vendor/edit{id}', 'App\Http\Controllers\DataVendorController@edit')->name('data_vendor.edit');

Route::post('data_vendor/update{id}', 'App\Http\Controllers\DataVendorController@update')->name('data_vendor.update');

Route::post('data_vendor/delete{id}', 'App\Http\Controllers\DataVendorController@destroy')->name('data_vendor.destroy');

Route::get('data_vendor/detail_vendor/{id}', 'App\Http\Controllers\DataVendorController@detail_vendor')->name('data_vendor.detail_vendor');

Route::get('data_barang', 'App\Http\Controllers\DataBarangController@index')->name('data_barang.index');

Route::get('data_barang/create', 'App\Http\Controllers\DataBarangController@create')->name('data_barang.create');

Route::post('data_barang/store', 'App\Http\Controllers\DataBarangController@store')->name('data_barang.store');

Route::get('data_barang/edit{id}', 'App\Http\Controllers\DataBarangController@edit')->name('data_barang.edit');

Route::post('data_barang/update{id}', 'App\Http\Controllers\DataBarangController@update')->name('data_barang.update');

Route::post('data_barang/delete{id}', 'App\Http\Controllers\DataBarangController@destroy')->name('data_barang.destroy');

Route::get('data_barang/detail_barang/{id}', 'App\Http\Controllers\DataBarangController@detail_barang')->name('data_barang.detail_barang');

Route::get('peminjaman', 'App\Http\Controllers\PeminjamanController@index')->name('peminjaman.index');

Route::get('peminjaman/create', 'App\Http\Controllers\PeminjamanController@create')->name('peminjaman.create');

Route::post('peminjaman/store', 'App\Http\Controllers\PeminjamanController@store')->name('peminjaman.store');

Route::post('peminjaman/update{id}', 'App\Http\Controllers\PeminjamanController@update')->name('peminjaman.update');