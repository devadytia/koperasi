<?php

use App\Http\Controllers\KoperasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KoperasiController::class, 'index'])->name('index');
Route::get('/create', [KoperasiController::class, 'create'])->name('create');
Route::get('/edit/{code}', [KoperasiController::class, 'edit'])->name('edit');
Route::get('/delete/{code}', [KoperasiController::class, 'delete'])->name('delete');
