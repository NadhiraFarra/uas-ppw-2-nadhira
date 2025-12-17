<?php

use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'index'])->name('index');

/* ================= PEKERJAAN ================= */
Route::prefix('pekerjaan')->group(function () {
    Route::get('/', [PekerjaanController::class, 'index'])->name('pekerjaan.index');
    Route::get('/add', [PekerjaanController::class, 'add'])->name('pekerjaan.add');
    Route::post('/insert', [PekerjaanController::class, 'store'])->name('pekerjaan.store');
    Route::get('/edit/{id}', [PekerjaanController::class, 'edit'])->name('pekerjaan.edit');
    Route::put('/update/{id}', [PekerjaanController::class, 'update'])->name('pekerjaan.update');
    Route::delete('/delete/{id}', [PekerjaanController::class, 'destroy'])->name('pekerjaan.destroy');
});

/* ================= PEGAWAI ================= */
Route::resource('pegawai', PegawaiController::class);

