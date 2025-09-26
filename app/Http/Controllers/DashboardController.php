<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::now();

        $totalReceitasMes = $user->lancamentos()->where('type', 'receita')->whereMonth('date', $today->month)->whereYear('date', $today->year)->sum('amount');
        $totalDespesasMes = $user->lancamentos()->where('type', 'despesa')->whereMonth('date', $today->month)->whereYear('date', $today->year)->sum('amount');
        $saldoAtual = $user->lancamentos()->where('type', 'receita')->sum('amount') - $user->lancamentos()->where('type', 'despesa')->sum('amount');

        $despesasPorCategoria = $user->lancamentos()
            ->where('type', 'despesa')->whereMonth('date', $today->month)->whereYear('date', $today->year)
            ->whereNotNull('category_id')
            ->join('categories', 'lancamentos.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(lancamentos.amount) as total'))
            ->groupBy('categories.name')->pluck('total', 'name');

        $evolutionData = ['labels' => [], 'receitas' => [], 'despesas' => []];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $evolutionData['labels'][] = $date->translatedFormat('M');
            $evolutionData['receitas'][] = $user->lancamentos()->where('type', 'receita')->whereYear('date', $date->year)->whereMonth('date', $date->month)->sum('amount');
            $evolutionData['despesas'][] = $user->lancamentos()->where('type', 'despesa')->whereYear('date', $date->year)->whereMonth('date', $date->month)->sum('amount');
        }

        $metasEmAndamento = $user->metas()->whereRaw('current_amount < target_amount')->orderByRaw('(current_amount / target_amount) DESC')->limit(3)->get();

        return view('dashboard', [
            'totalReceitasMes' => $totalReceitasMes,
            'totalDespesasMes' => $totalDespesasMes,
            'saldoAtual' => $saldoAtual,
            'categoryLabels' => $despesasPorCategoria->keys(),
            'categoryTotals' => $despesasPorCategoria->values(),
            'evolutionLabels' => json_encode($evolutionData['labels']),
            'evolutionReceitas' => json_encode($evolutionData['receitas']),
            'evolutionDespesas' => json_encode($evolutionData['despesas']),
            'metasEmAndamento' => $metasEmAndamento,
        ]);
    }
}