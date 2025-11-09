<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $period = $request->get('periodo', '28d'); 
        $start = $request->get('start_date');
        $end = $request->get('end_date');

        switch ($period) {
            case '7d':
                $startDate = Carbon::now()->subDays(6)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                break;
            case '28d':
                $startDate = Carbon::now()->subDays(27)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                break;
            case 'month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
            case 'year':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            case 'custom':
                if ($start && $end) {
                    $startDate = Carbon::parse($start)->startOfDay();
                    $endDate = Carbon::parse($end)->endOfDay();
                } else {
                    $startDate = Carbon::now()->subDays(27)->startOfDay();
                    $endDate = Carbon::now()->endOfDay();
                }
                break;
            default:
                $startDate = Carbon::now()->subDays(27)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
        }

        // KPIs
        $totalReceitasMes = $user->lancamentos()
            ->where('type', 'receita')
            ->whereNull('meta_id')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');

        $totalDespesasMes = $user->lancamentos()
            ->where('type', 'despesa')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');

        $saldoAtual = $totalReceitasMes - $totalDespesasMes;

        // Gráfico pizza
        $despesasPorCategoria = $user->lancamentos()
            ->where('type', 'despesa')
            ->whereBetween('date', [$startDate, $endDate])
            ->whereNotNull('category_id')
            ->join('categories', 'lancamentos.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(lancamentos.amount) as total'))
            ->groupBy('categories.name')
            ->pluck('total', 'name');

        // Evolução financeira: valores para cada dia
        $periodLength = $startDate->diffInDays($endDate) + 1;
        $labels = [];
        $receitasData = [];
        $despesasData = [];
        for ($i = 0; $i < $periodLength; $i++) {
            $date = $startDate->copy()->addDays($i);
            $labels[] = $date->translatedFormat('d/m');
            $receitasData[] = $user->lancamentos()
                ->where('type', 'receita')
                ->whereNull('meta_id')
                ->whereDate('date', $date)
                ->sum('amount');
            $despesasData[] = $user->lancamentos()
                ->where('type', 'despesa')
                ->whereDate('date', $date)
                ->sum('amount');
        }

        // Metas e conquistas
        $metasEmAndamento = $user->metas()
            ->whereRaw('current_amount < target_amount')
            ->orderByRaw('(current_amount / target_amount) DESC')
            ->limit(3)
            ->get();

        $recentAchievements = $user->achievements()
            ->latest('user_achievement.created_at')
            ->limit(3)
            ->get();

        return view('dashboard', [
            'totalReceitasMes' => $totalReceitasMes,
            'totalDespesasMes' => $totalDespesasMes,
            'saldoAtual' => $saldoAtual,
            'categoryLabels' => json_encode(array_values($despesasPorCategoria->keys()->toArray())),
            'categoryTotals' => json_encode(array_values($despesasPorCategoria->values()->toArray())),
            'evolutionLabels' => json_encode(array_values($labels)),
            'evolutionReceitas' => json_encode(array_values($receitasData)),
            'evolutionDespesas' => json_encode(array_values($despesasData)),
            'metasEmAndamento' => $metasEmAndamento,
            'recentAchievements' => $recentAchievements,
            'period' => $period,
            'start_date' => $startDate,
            'end_date' => $endDate,
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

    /**
     * Endpoint AJAX para dados dinâmicos.
     */
    public function data(Request $request)
    {
        $user = Auth::user();
        $period = $request->get('periodo', '28d'); // padrão consistência AJAX!
        $start = $request->get('start_date');
        $end = $request->get('end_date');
        $today = Carbon::now();

        switch ($period) {
            case '7d':
                $startDate = Carbon::now()->subDays(6)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                break;
            case '28d':
                $startDate = Carbon::now()->subDays(27)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                break;
            case 'month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
            case 'year':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            case 'custom':
                if ($start && $end) {
                    $startDate = Carbon::parse($start)->startOfDay();
                    $endDate = Carbon::parse($end)->endOfDay();
                } else {
                    $startDate = Carbon::now()->subDays(27)->startOfDay();
                    $endDate = Carbon::now()->endOfDay();
                }
                break;
            default:
                $startDate = Carbon::now()->subDays(27)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
        }

        // KPIs filtrados
        $totalReceitas = $user->lancamentos()
            ->where('type', 'receita')
            ->whereNull('meta_id')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');

        $totalDespesas = $user->lancamentos()
            ->where('type', 'despesa')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('amount');

        $saldoAtual = $totalReceitas - $totalDespesas;

        // Gráfico pizza
        $despesasPorCategoria = $user->lancamentos()
            ->where('type', 'despesa')
            ->whereBetween('date', [$startDate, $endDate])
            ->whereNotNull('category_id')
            ->join('categories', 'lancamentos.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(lancamentos.amount) as total'))
            ->groupBy('categories.name')
            ->pluck('total', 'name');

        // Evolução financeira
        $labels = [];
        $receitas = [];
        $despesas = [];
        if ($period == 'year') {
            for ($i = 1; $i <= 12; $i++) {
                $label = Carbon::create()->month($i)->translatedFormat('M');
                $labels[] = $label;
                $receitas[] = $user->lancamentos()
                    ->where('type', 'receita')
                    ->whereNull('meta_id')
                    ->whereMonth('date', $i)
                    ->whereYear('date', $today->year)
                    ->sum('amount');
                $despesas[] = $user->lancamentos()
                    ->where('type', 'despesa')
                    ->whereMonth('date', $i)
                    ->whereYear('date', $today->year)
                    ->sum('amount');
            }
        } else {
            $periodLength = $startDate->diffInDays($endDate) + 1;
            for ($i = 0; $i < $periodLength; $i++) {
                $date = $startDate->copy()->addDays($i);
                $labels[] = $date->translatedFormat('d/m');
                $receitas[] = $user->lancamentos()
                    ->where('type', 'receita')
                    ->whereNull('meta_id')
                    ->whereDate('date', $date)
                    ->sum('amount');
                $despesas[] = $user->lancamentos()
                    ->where('type', 'despesa')
                    ->whereDate('date', $date)
                    ->sum('amount');
            }
        }

        return response()->json([
            'totalReceitas' => $totalReceitas,
            'totalDespesas' => $totalDespesas,
            'saldoAtual' => $saldoAtual,
            'categoryLabels' => array_values($despesasPorCategoria->keys()->toArray()),
            'categoryTotals' => array_values($despesasPorCategoria->values()->toArray()),
            'evolutionLabels' => array_values($labels),
            'evolutionReceitas' => array_values($receitas),
            'evolutionDespesas' => array_values($despesas),
        ]);
    }
}
