<?php

use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MetaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
|
| Estas rotas são acessíveis a todos os visitantes, logados ou não.
|
*/

// Página inicial
Route::get('/', function () {
    return view('welcome');
});

// Suas URLs personalizadas para as páginas de autenticação do Breeze.
// O uso de ->name() é crucial para a integração com o Laravel.
Route::get('/entrar', function () {
    return view('auth.login');
})->name('login');

Route::get('/cadastro', function () {
    return view('auth.register');
})->name('register');

// Página de dicas, assumindo que seja pública.
Route::get('/dicas', function () {
    return view('dicas');
})->name('dicas');


/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Exigem Autenticação)
|--------------------------------------------------------------------------
|
| Todas as rotas dentro deste grupo só podem ser acessadas por usuários
| que já fizeram login. O middleware 'auth' e 'verified' garantem isso.
| 'verified' garante que o usuário já verificou seu e-mail.
|
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Rota do Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rotas do Perfil do Usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('lancamentos', LancamentoController::class);

   //Route::get('/metas', function () {
   //     return view('metas');
    //})->name('metas');

    // Dentro do Route::middleware(['auth', 'verified'])->group(...)
    Route::resource('metas', MetaController::class);

    Route::get('/relatorios', function () {
        return view('relatorios');
    })->name('relatorios');

    Route::get('/configuracoes', function () {
        return view('configuracoes');
    })->name('configuracoes');
});


require __DIR__ . '/auth.php';