<?php

use App\Http\Controllers\KoperasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KoperasiController::class, 'index'])->name('index');
Route::get('/create', [KoperasiController::class, 'create'])->name('create');
Route::post('/store', [KoperasiController::class, 'store'])->name('store');
Route::get('/edit/{code}', [KoperasiController::class, 'edit'])->name('edit');
Route::post('/update/{code}', [KoperasiController::class, 'update'])->name('update');