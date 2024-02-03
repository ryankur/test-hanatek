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


Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/', function () {
    return view('dashboard');
});
Route::get('/dashboard', [App\Http\Controllers\MasterPenggunaController::class, 'dashboardPages'])->name('dashboard');
Route::get('/master-pengguna', [App\Http\Controllers\MasterPenggunaController::class, 'masterPenggunaPages'])->name('master');
Route::get('/edit-pengguna/{id}', [App\Http\Controllers\MasterPenggunaController::class, 'editPenggunaPages'])->name('edit');
Route::get('/tambah-master-pengguna', [App\Http\Controllers\MasterPenggunaController::class, 'tambahPenggunaPages'])->name('tambah');





