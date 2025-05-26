<?php

use App\Http\Controllers\BemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(BemController::class)->group(function(){
    Route::get('/bens','index')->middleware(['auth', 'verified'])->name('bens');
    Route::get('/bens/cadastrar','create')->middleware(['auth', 'verified'])->name('bens.create');
    Route::get('/bens/{bem}','show')->where('bem', '[0-9]+')->middleware(['auth', 'verified'])->name('bens.show');
    Route::post('/bens','store')->middleware(['auth', 'verified'])->name('bens.store');
    Route::get('/bens/{bem}/editar','edit')->where('bem', '[0-9]+')->middleware(['auth', 'verified'])->name('bens.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
