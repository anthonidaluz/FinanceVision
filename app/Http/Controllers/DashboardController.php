<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Pega o usuário que está logado
        $user = Auth::user();

        // 2. Busca no banco de dados todos os lançamentos do tipo 'receita' DESTE usuário e soma os valores
        $totalReceitas = $user->lancamentos()->where('type', 'receita')->sum('amount');

        // 3. Retorna a view do dashboard e envia a variável com o total
        return view('dashboard', [
            'totalReceitas' => $totalReceitas
        ]);
    }
}