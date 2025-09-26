<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

// Página inicial
Route::get('/', function () {
    return view('auth.login');
});

// URLs personalizadas para as páginas de autenticação do Breeze.
Route::get('/entrar', function () {
    return view('auth.login');
})->name('login');

Route::get('/cadastro', function () {
    return view('auth.register');
})->name('register');

// Página de dicas
Route::get('/dicas', function () {
    return view('dicas');
})->name('dicas');


/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Exigem Autenticação)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rotas do Perfil do Usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas de Recursos (CRUDs)
    Route::resource('lancamentos', LancamentoController::class);
    Route::get('/relatorios', [ReportController::class, 'index'])->name('relatorios.index');
    Route::resource('categorias', CategoryController::class);
    Route::resource('metas', MetaController::class);

    Route::get('/configuracoes', function () {
        return view('configuracoes');
    })->name('configuracoes');
});


/*
|--------------------------------------------------------------------------
| Rotas de Lógica de Autenticação do Breeze
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';