<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::now();

        // --- DADOS PARA OS CARDS DE INDICADORES (KPIs) ---

        // CORREÇÃO: "Receitas (Mês)" agora exclui o que foi vinculado a uma meta
        $totalReceitasMes = $user->lancamentos()
            ->where('type', 'receita')
            ->whereYear('date', $today->year)
            ->whereMonth('date', $today->month)
            ->whereNull('meta_id') // <-- A MÁGICA ACONTECE AQUI
            ->sum('amount');

        // Despesas continuam iguais
        $totalDespesasMes = $user->lancamentos()
            ->where('type', 'despesa')
            ->whereYear('date', $today->year)
            ->whereMonth('date', $today->month)
            ->sum('amount');

        // CORREÇÃO: "Saldo Total" também deve refletir o dinheiro "em conta", excluindo o que já foi para metas
        $saldoAtual = $user->lancamentos()->where('type', 'receita')->whereNull('meta_id')->sum('amount')
            - $user->lancamentos()->where('type', 'despesa')->sum('amount');

        // --- DADOS PARA O GRÁFICO DE DESPESAS POR CATEGORIA (PIZZA) ---
        $despesasPorCategoria = $user->lancamentos()
            ->where('type', 'despesa')
            ->whereYear('date', $today->year)
            ->whereMonth('date', $today->month)
            ->whereNotNull('category_id')
            ->join('categories', 'lancamentos.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(lancamentos.amount) as total'))
            ->groupBy('categories.name')
            ->pluck('total', 'name');

        // --- DADOS PARA O GRÁFICO DE EVOLUÇÃO FINANCEIRA (LINHAS) ---
        // Este gráfico deve mostrar o fluxo de caixa TOTAL, incluindo aportes, por isso NÃO adicionamos o whereNull aqui.
        $evolutionData = ['labels' => [], 'receitas' => [], 'despesas' => []];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $evolutionData['labels'][] = $date->translatedFormat('M');
            // Receita total (incluindo aportes)
            $evolutionData['receitas'][] = $user->lancamentos()->where('type', 'receita')->whereYear('date', $date->year)->whereMonth('date', $date->month)->sum('amount');
            $evolutionData['despesas'][] = $user->lancamentos()->where('type', 'despesa')->whereYear('date', $date->year)->whereMonth('date', $date->month)->sum('amount');
        }

        // --- DADOS PARA AS METAS EM DESTAQUE ---
        $metasEmAndamento = $user->metas()->whereRaw('current_amount < target_amount')->orderByRaw('(current_amount / target_amount) DESC')->limit(3)->get();

        // --- DADOS PARA ATIVIDADE RECENTE ---
        $recentAchievements = $user->achievements()->latest('user_achievement.created_at')->limit(3)->get();

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
            'recentAchievements' => $recentAchievements,
        ]);
    }

    /**
     * Exibe a página de conquistas do usuário.
     */
    public function achievements()
    {
        $achievements = Auth::user()->achievements()->latest('user_achievement.created_at')->get();
        return view('achievements.index', compact('achievements'));
    }
}