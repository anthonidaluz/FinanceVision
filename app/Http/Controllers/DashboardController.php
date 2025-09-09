<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Garanta que este 'use' está aqui
use Carbon\Carbon;                  // E este também

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::now();

        // --- Cálculos para os Cards de Indicadores (KPIs) ---
        $totalReceitasMes = $user->lancamentos()->where('type', 'receita')->whereMonth('date', $today->month)->whereYear('date', $today->year)->sum('amount');
        $totalDespesasMes = $user->lancamentos()->where('type', 'despesa')->whereMonth('date', $today->month)->whereYear('date', $today->year)->sum('amount');

        // --- Preparação de Dados para Gráficos e Listas ---
        // Nota: Esta consulta pode dar erro se não houver a tabela 'categories' ou a coluna 'category_id'.
        // Vamos comentar por enquanto para focar no erro atual.
        // $despesasPorCategoria = $user->lancamentos()
        //     ->where('type', 'despesa')->whereMonth('date', $today->month)->whereYear('date', $today->year)
        //     ->join('categories', 'lancamentos.category_id', '=', 'categories.id')
        //     ->select('categories.name', DB::raw('SUM(lancamentos.amount) as total'))
        //     ->groupBy('categories.name')->pluck('total', 'name');

        // --- LÓGICA PARA BUSCAR AS METAS EM ANDAMENTO ---
        $metasEmAndamento = $user->metas()->whereRaw('current_amount < target_amount')->orderByRaw('(current_amount / target_amount) DESC')->limit(3)->get();

        // --- Retorno da view com TODAS as variáveis ---
        return view('dashboard', [
            'totalReceitasMes' => $totalReceitasMes,
            'totalDespesasMes' => $totalDespesasMes,
            // 'despesasPorCategoria' => $despesasPorCategoria ?? collect(), // Usamos collect() para garantir que seja sempre uma coleção
            'metasEmAndamento' => $metasEmAndamento, // <-- A variável agora está sendo enviada
        ]);
    }
}