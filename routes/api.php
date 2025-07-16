<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KoperasiController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\KaryawanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::name('api.')->group(function() {
    Route::name('koperasi.')->prefix('koperasi')->group(function () {
        Route::get('/', [KoperasiController::class, 'index'])->name('index');
        Route::post('/store', [KoperasiController::class, 'store'])->name('store');;
        Route::get('/edit/{code}', [KoperasiController::class, 'edit'])->name('edit');;
        Route::post('/update/{code}', [KoperasiController::class, 'update'])->name('update');;
        Route::post('/delete/{code}', [KoperasiController::class, 'delete'])->name('delete');;
    });

    Route::get('/item', [ItemController::class, 'index'])->name('item.index');
    Route::get('/employee', [KaryawanController::class, 'index'])->name('employee.index');
});
