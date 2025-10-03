<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\LancamentoCreated;

class LancamentoController extends Controller
{
    /**
     * Exibe a lista de lançamentos e o formulário de criação.
     */
    public function index()
    {
        $user = Auth::user();

        // Usamos with() para otimizar as buscas, carregando os relacionamentos de uma vez
        $lancamentos = $user->lancamentos()->with(['category', 'meta'])->latest('date')->get();
        $metas = $user->metas()->get();
        $categories = $user->categories()->orderBy('name')->get(); // Buscamos as categorias

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

        // Usamos uma transaction para garantir a integridade dos dados
        DB::transaction(function () use ($validated, $request) {
            // 1. Cria o lançamento
            $lancamento = Auth::user()->lancamentos()->create($validated);

            // 2. Atualiza o progresso da meta, se houver
            if (isset($validated['meta_id'])) {
                $meta = Auth::user()->metas()->findOrFail($validated['meta_id']);
                if ($lancamento->type === 'receita') {
                    $meta->increment('current_amount', $lancamento->amount);
                }
                // A lógica para despesas em metas pode ser adicionada aqui no futuro
            }

            // 3. DISPARA O EVENTO DE GAMIFICAÇÃO
            // Anuncia para a aplicação que um novo lançamento foi criado.
            LancamentoCreated::dispatch($lancamento);
        });

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