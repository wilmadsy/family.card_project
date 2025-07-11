<?php

use App\Http\Controllers\familycontroller;
use App\Http\Controllers\familymembercontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kk/home', [familymembercontroller::class, 'index'])->name('data.index');

Route::get('/kk/show/{id}', [familymembercontroller::class, 'show'])->name('data.show');

Route::get('/kk/create', [familymembercontroller::class, 'create'])->name('data.create');

Route::get('/kk/create_m/{id}', [familymembercontroller::class, 'create_m'])->name('data_m.create');

Route::post('/kk/store', [familymembercontroller::class, 'store'])->name('data.store');

Route::post('/kk/store_m', [familymembercontroller::class, 'store_m'])->name('data_m.store');

Route::get('/kk/edit/{id}', [familymembercontroller::class, 'edit'])->name('data.edit');

Route::put('/kk/{id}', [familymembercontroller::class, 'update'])->name('data.update');

Route::delete('/kk/delete/{id}', [familymembercontroller::class, 'destroy'])->name('data.delete');

Route::get('/kk/edit_m/{id}', [familymembercontroller::class, 'edit_m'])->name('data_m.edit');

Route::put('/kk/m-up/{id}', [familymembercontroller::class, 'update_m'])->name('data_m.update');

Route::delete('/kk/m-del/{id}', [familymembercontroller::class, 'delete'])->name('data_m.delete');

Route::get('kk/pdf/{id}', [familymembercontroller::class, 'pdf']);

Route::get('kk/download/pdf/{id}', [familymembercontroller::class, 'dowmload_pdf']);
