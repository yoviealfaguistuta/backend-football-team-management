<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Private\JadwalPertandinganController;
use App\Http\Controllers\Private\PemainController;
use App\Http\Controllers\Private\PerusahaanController;
use App\Http\Controllers\Private\TimController;
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

Route::post('/login', [LoginController::class, 'login'])->name('go_login');

Route::group(['middleware' => 'auth:sanctum'], function () { 

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('user');

    Route::prefix('perusahaan')->group(function () {
        Route::get('', [PerusahaanController::class, 'list'])->name('admin.perusahaan');
        Route::post('', [PerusahaanController::class, 'create'])->name('admin.perusahaan.create');
        Route::post('{id}', [PerusahaanController::class, 'update'])->name('admin.perusahaan.update');
        Route::delete('{id}', [PerusahaanController::class, 'delete'])->name('admin.perusahaan.delete');
    });

    Route::prefix('tim')->group(function () {
        Route::get('', [TimController::class, 'list'])->name('admin.tim');
        Route::post('', [TimController::class, 'create'])->name('admin.tim.create');
        Route::post('{id}', [TimController::class, 'update'])->name('admin.tim.update');
        Route::delete('{id}', [TimController::class, 'delete'])->name('admin.tim.delete');
    });

    Route::prefix('pemain')->group(function () {
        Route::get('', [PemainController::class, 'list'])->name('admin.pemain');
        Route::post('', [PemainController::class, 'create'])->name('admin.pemain.create');
        Route::post('{id}', [PemainController::class, 'update'])->name('admin.pemain.update');
        Route::delete('{id}', [PemainController::class, 'delete'])->name('admin.pemain.delete');
    });

    Route::prefix('jadwal-pertandingan')->group(function () {
        Route::get('', [JadwalPertandinganController::class, 'list'])->name('admin.jadwal-pertandingan');
        Route::post('', [JadwalPertandinganController::class, 'create'])->name('admin.jadwal-pertandingan.create');
        Route::post('{id}', [JadwalPertandinganController::class, 'update'])->name('admin.jadwal-pertandingan.update');
        Route::delete('{id}', [JadwalPertandinganController::class, 'delete'])->name('admin.jadwal-pertandingan.delete');
    });
   
});