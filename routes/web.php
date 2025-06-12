<?php

use App\Http\Controllers\BemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(BemController::class)->group(function () {
    Route::get('/bens', 'index')->middleware(['auth', 'verified'])->name('bens');
    Route::get('/bens/registar', 'create')->middleware(['auth', 'verified'])->name('bens.create');
    Route::get('/bens/{bem}', 'show')->where('bem', '[0-9]+')->middleware(['auth', 'verified'])->name('bens.show');
    Route::post('/bens', 'store')->middleware(['auth', 'verified'])->name('bens.store');
    Route::get('/bens/{bem}/editar', 'edit')->where('bem', '[0-9]+')->middleware(['auth', 'verified'])->name('bens.edit');
    Route::patch('/bens/{bem}/detalhes', 'updateDetalhes')->where('bem', '[0-9]+')->middleware(['auth', 'verified'])->name('bens.updateDetalhes');
    Route::patch('/bens/{bem}/localizacao', 'updateLocalizacao')->where('bem', '[0-9]+')->middleware(['auth', 'verified'])->name('bens.updateLocalizacao');
    Route::patch('/bens/{bem}/responsavel', 'updateResponsavel')->where('bem', '[0-9]+')->middleware(['auth', 'verified'])->name('bens.updateResponsavel');
    Route::delete('/bens/{bem}', 'destroy')->where('bem', '[0-9]+')->middleware(['auth', 'verified'])->name('bens.delete');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/usuarios', 'index')->middleware(['auth', 'verified'])->name('users');
    Route::get('/usuarios/cadastrar', 'create')->middleware(['auth', 'verified'])->name('users.create');
    Route::post('/usuarios', 'store')->middleware(['auth', 'verified'])->name('users.store');
    Route::delete('/usuarios/{user}', 'destroy')->where('user', '[0-9]+')->middleware(['auth', 'verified'])->name('users.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::controller(RelatorioController::class)->group(function () {
    Route::get('/relatorios/bensGeral', 'gerarRelatorioBens')->middleware(['auth', 'verified'])->name('relatorios.bensGeral');
    Route::get('/realtorios/bensResposavel/{user}', 'gerarRelatorioResponsavel')->where('user', '[0-9]+')->middleware(['auth', 'verified'])->name('relatorios.bensResposavel');
    Route::get('/realtorios/bemFicha/{bem}', 'gerarRelatorioFichaDoBem')->where('user', '[0-9]+')->middleware(['auth', 'verified'])->name('relatorios.bemFicha');
});

require __DIR__ . '/auth.php';
