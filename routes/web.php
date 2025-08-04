<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/entrar', function () {
    return view('entrar'); 
});

Route::get('/cadastro', function () {
    return view(view:'cadastro');
}); 

Route::get('/esqueceu-senha', function () {
    return view(view:'esqueceu-senha');
}); 

Route::get('/dicas', function () {
    return view(view:'dicas');
}); 

Route::get('/configuracoes', function () {
    return view(view:'configuracoes');
}); 

Route::get('/relatorios', function () {
    return view(view:'relatorios');
}); 

Route::get('/metas', function () {
    return view(view:'metas');
}); 

Route::get('/lancamentos', function () {
    return view(view:'lancamentos');
}); 

Route::get('/dashboard', function () {
    return view(view:'dashboard');
}); 