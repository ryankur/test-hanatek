<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [App\Http\Controllers\ApiController::class, 'login'])->name('api.login');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [App\Http\Controllers\ApiController::class, 'logout'])->name('api.logout');
   
});
Route::get('/list-data', [App\Http\Controllers\ApiController::class, 'list'])->name('api.list');
Route::post('/api-tambah', [App\Http\Controllers\ApiController::class, 'tambahPengguna'])->name('api.tambah');
Route::get('/api-edit/{id}', [App\Http\Controllers\ApiController::class, 'edit'])->name('api.edit');
Route::post('/api-edit-post/{id}', [App\Http\Controllers\ApiController::class, 'editPost'])->name('api.editPost');
Route::delete('/api-delete/{id}', [App\Http\Controllers\ApiController::class, 'delete'])->name('api.delete');
Route::get('/dashboard', [App\Http\Controllers\ApiController::class, 'dashboard'])->name('api.dashboard');





