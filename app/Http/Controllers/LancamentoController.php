<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\LancamentoCreated;
use App\Events\MetaCompleted;

class LancamentoController extends Controller
{
    public function index(Request $request) // Adicionamos a Request
    {
        $user = Auth::user();

        // 1. MUDANÇA: Trocamos ->get() por ->paginate(10)
        $lancamentos = $user->lancamentos()
            ->with(['category', 'meta'])
            ->latest('date')
            ->paginate(10); // Pode ajustar o número (ex: 5 ou 15)

        $metas = $user->metas()->get();
        $categories = $user->categories()->orderBy('name')->get();

        // 2. MUDANÇA: Lógica inteligente de resposta
        if ($request->ajax()) {
            // Se for um pedido AJAX (do nosso JavaScript), devolve SÓ a tabela
            return view('lancamentos.partials.historico-tabela', compact('lancamentos'))->render();
        }

        // Se for um pedido normal, devolve a página inteira
        return view('lancamentos.index', compact('lancamentos', 'metas', 'categories'));
    }

    /**
     * Salva um novo lançamento.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:receita,despesa',
            'date' => 'required|date',
            'category_id' => 'nullable|exists:categories,id',
            'meta_id' => 'nullable|exists:metas,id',
        ]);

        $lancamento = null;

        DB::transaction(function () use ($validated, &$lancamento) {
            $lancamento = Auth::user()->lancamentos()->create($validated);

            if (isset($validated['meta_id'])) {
                $meta = Auth::user()->metas()->findOrFail($validated['meta_id']);

                // Verifica se a meta JÁ estava completa ANTES deste lançamento
                $wasCompleted = $meta->progress >= 100;

                if ($lancamento->type === 'receita') {
                    $meta->increment('current_amount', $lancamento->amount);
                }

                $meta->refresh();

                // Verifica se a meta ESTÁ completa AGORA
                $isNowCompleted = $meta->progress >= 100;

                if ($isNowCompleted && !$wasCompleted) {
                    MetaCompleted::dispatch($meta->user);
                }

                // Conquista: vincular lançamento a uma meta
                $achievement = \App\Models\Achievement::where('slug', 'estrategista')->first();
                if ($achievement && !$meta->user->achievements()->where('achievement_id', $achievement->id)->exists()) {
                    $meta->user->achievements()->attach($achievement->id);

                    // Notificação imediata
                    session()->now('new_achievement', $achievement);
                }
            }
        });

        // Evento de criação de lançamento (para outras conquistas)
        LancamentoCreated::dispatch($lancamento);

        return redirect()->route('lancamentos.index')->with('success', 'Lançamento adicionado com sucesso!');
    }


    /**
     * Mostra o formulário para editar um lançamento.
     */
    public function edit(Lancamento $lancamento)
    {
        if ($lancamento->user_id !== Auth::id())
            abort(403);

        $user = Auth::user();
        $metas = $user->metas()->get();
        $categories = $user->categories()->orderBy('name')->get();

        return view('lancamentos.edit', compact('lancamento', 'metas', 'categories'));
    }

    /**
     * Atualiza um lançamento existente.
     */
    public function update(Request $request, Lancamento $lancamento)
    {
        if ($lancamento->user_id !== Auth::id())
            abort(403);

        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:receita,despesa',
            'date' => 'required|date',
            'category_id' => 'nullable|exists:categories,id',
            'meta_id' => 'nullable|exists:metas,id',
        ]);

        // Lógica de atualização de metas precisa ser refinada aqui, se necessário.
        $lancamento->update($validated);

        return redirect()->route('lancamentos.index')->with('success', 'Lançamento atualizado com sucesso!');
    }

    /**
     * Exclui um lançamento.
     */
    public function destroy(Lancamento $lancamento)
    {
        if ($lancamento->user_id !== Auth::id())
            abort(403);

        // Lógica de atualização de metas ao excluir precisa ser refinada aqui, se necessário.
        $lancamento->delete();

        return redirect()->route('lancamentos.index')->with('success', 'Lançamento excluído com sucesso!');
    }
}