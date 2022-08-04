<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Private\PerusahaanController;
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
   
});