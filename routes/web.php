<?php

use App\Http\Controllers\Public\DocController;
use App\Http\Controllers\SiteController;
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

Route::get('/', [DocController::class, 'index'])->name('/');
Route::prefix('api-docs')->group(function () {
    Route::get('studi-kasus', [DocController::class, 'studi_kasus'])->name('studi-kasus');
    Route::get('authentication', [DocController::class, 'authentication'])->name('authentication');
    Route::get('perusahaan', [DocController::class, 'perusahaan'])->name('perusahaan');
    Route::get('tim', [DocController::class, 'tim'])->name('tim');
    Route::get('pemain', [DocController::class, 'pemain'])->name('pemain');
    Route::get('jadwal-pertandingan', [DocController::class, 'jadwal_pertandingan'])->name('jadwal-pertandingan');
    Route::get('hasil-pertandingan', [DocController::class, 'hasil_pertandingan'])->name('hasil-pertandingan');
    Route::get('report', [DocController::class, 'report'])->name('report');
});
