<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\ReportViewed;
use App\Models\Lancamento;
use App\Models\Meta;

class ReportController extends Controller
{
    /**
     * Exibe a tela principal de relatórios.
     */
    public function index()
    {
        return view('relatorios.index');
    }

    /**
     * Gera o relatório com base nos filtros enviados.
     */
    public function gerar(Request $request)
    {

        $user = Auth::user();
        $validated = $request->validate([
            'report_type' => 'required|in:fluxo,metas',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',

            ReportViewed::dispatch($user)
        ]);

        $user = Auth::user();
        $inicio = $validated['start_date'] ?? now()->startOfMonth()->toDateString();
        $fim = $validated['end_date'] ?? now()->endOfMonth()->toDateString();

        if ($validated['report_type'] === 'fluxo') {
            $lancamentos = $user->lancamentos()
                ->with(['category', 'meta'])
                ->whereBetween('date', [$inicio, $fim])
                ->get();

            $receitas = $lancamentos->where('type', 'receita')->sum('amount');
            $despesas = $lancamentos->where('type', 'despesa')->sum('amount');
            $saldo = $receitas - $despesas;

            $porCategoria = $lancamentos->groupBy(function ($l) {
                return optional($l->category)->name ?? 'Sem Categoria';
            })->map(function ($group) {
                return $group->sum('amount');
            });

            return view('relatorios.fluxo', compact(
                'receitas',
                'despesas',
                'saldo',
                'porCategoria',
                'inicio',
                'fim',
                'lancamentos'
            ));
        }

        if ($validated['report_type'] === 'metas') {
            $metas = $user->metas()->with('lancamentos')->get();

            $dados = $metas->map(function ($meta) use ($inicio, $fim) {
                $totalRecebido = $meta->lancamentos()
                    ->where('type', 'receita')
                    ->whereBetween('date', [$inicio, $fim])
                    ->sum('amount');

                $progresso = $meta->target_amount > 0
                    ? round(($totalRecebido / $meta->target_amount) * 100, 2)
                    : 0;

                return [
                    'titulo' => $meta->name,
                    'valor' => $meta->target_amount,
                    'progresso' => min($progresso, 100),
                    'recebido' => $totalRecebido,
                    'prazo' => $meta->deadline ?? null,
                ];
            });

            return view('relatorios.metas', compact('dados', 'inicio', 'fim'));
        }

        return redirect()->route('relatorios.index')->with('error', 'Tipo de relatório inválido.');
    }
}