<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LancamentoImportController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

// Página inicial
Route::get('/', function () {
    return view('welcome');
});

// URLs personalizadas para as páginas de autenticação do Breeze.
Route::get('/entrar', function () {
    return view('auth.login');
})->name('login');

Route::get('/cadastro', function () {
    return view('auth.register');
})->name('register');


//Políticas ed Privacidade
Route::get('/politica-de-privacidade', function () {
    return view('politica-privacidade');
})->name('privacy.policy');

// Perguntas Frequentes
Route::get('/perguntas-frequentes', function () {
    return view('perguntas-frequentes');
})->name('faq');

// Sobre Nós
Route::get('/sobre-nos', function () {
    return view('sobre-nos');
})->name('sobre-nos');



// Login com Google
Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Exigem Autenticação)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [App\Http\Controllers\DashboardController::class, 'data'])->name('dashboard.data');


    // Rotas do Perfil do Usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas de Recursos (CRUDs)
    Route::resource('lancamentos', LancamentoController::class)->except([
        'create',
        'show'
    ]);




    // Rotas para Importação de Lançamentos
    Route::get('/lancamentos/importar', [LancamentoImportController::class, 'index'])->name('lancamentos.importar');
    Route::post('/lancamentos/importar', [LancamentoImportController::class, 'processar'])->name('lancamentos.importar.processar');

    // Rota para mostrar a página de revisão
    Route::get('/lancamentos/importar/revisar', [LancamentoImportController::class, 'revisar'])->name('lancamentos.importar.revisar');
    // Rota para salvar os dados da revisão
    Route::post('/lancamentos/importar/salvar', [LancamentoImportController::class, 'salvar'])->name('lancamentos.importar.salvar');


    // A página para fazer o upload
    Route::get('/lancamentos/importar', [LancamentoImportController::class, 'index'])->name('lancamentos.importar');
    // A rota que vai receber o ficheiro e falar com a IA
    Route::post('/lancamentos/importar/processar', [LancamentoImportController::class, 'processar'])->name('lancamentos.importar.processar');
    Route::get('/relatorios', [ReportController::class, 'index'])->name('relatorios.index');

    Route::get('/relatorios/fluxo-caixa', [ReportController::class, 'fluxoCaixa'])
        ->name('relatorios.fluxo-caixa');
    Route::get('/relatorios/gerar', [ReportController::class, 'gerar'])->name('relatorios.gerar');

    Route::resource('categorias', CategoryController::class);
    Route::resource('metas', MetaController::class);


    Route::get('/conquistas', [DashboardController::class, 'achievements'])->name('achievements.index');

    Route::get('/dicas', [PageController::class, 'dicas'])->name('dicas');

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