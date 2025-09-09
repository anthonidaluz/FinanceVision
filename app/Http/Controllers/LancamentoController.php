<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// A correção principal é garantir que "extends Controller" esteja aqui
class LancamentoController extends Controller 
{
    public function index()
    {
        $lancamentos = Auth::user()->lancamentos()->latest('date')->get();
        $metas = Auth::user()->metas()->get();
        return view('lancamentos.index', compact('lancamentos', 'metas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:receita,despesa',
            'meta_id' => 'nullable|exists:metas,id',
            'date' => 'required|date',
        ]);

        DB::transaction(function () use ($validated) {
            $lancamento = Auth::user()->lancamentos()->create($validated);
            if (isset($validated['meta_id'])) {
                $meta = Auth::user()->metas()->findOrFail($validated['meta_id']);
                $this->updateMetaProgress($meta, $lancamento->amount, $lancamento->type);
            }
        });

        return redirect()->route('lancamentos.index')->with('success', 'Lançamento adicionado com sucesso!');
    }

    public function edit(Lancamento $lancamento)
    {
        // Verificação de segurança direta
        if (Auth::user()->id !== $lancamento->user_id) {
            abort(403, 'Acesso Não Autorizado');
        }

        $metas = Auth::user()->metas()->get();
        return view('lancamentos.edit', compact('lancamento', 'metas'));
    }

    public function update(Request $request, Lancamento $lancamento)
    {
        // Verificação de segurança direta
        if (Auth::user()->id !== $lancamento->user_id) {
            abort(403, 'Acesso Não Autorizado');
        }

        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:receita,despesa',
            'meta_id' => 'nullable|exists:metas,id',
            'date' => 'required|date',
        ]);
        
        DB::transaction(function () use ($lancamento, $validated) {
            // Reverte o valor antigo da meta antiga (se existir)
            if ($lancamento->meta_id) {
                $this->updateMetaProgress($lancamento->meta, $lancamento->amount, $lancamento->type, true); // Inverte
            }

            $lancamento->update($validated);

            // Aplica o novo valor na nova meta (se existir)
            if ($lancamento->meta_id) {
                $this->updateMetaProgress($lancamento->meta, $lancamento->amount, $lancamento->type);
            }
        });

        return redirect()->route('lancamentos.index')->with('success', 'Lançamento atualizado com sucesso!');
    }

    public function destroy(Lancamento $lancamento)
    {
        // Verificação de segurança direta
        if (Auth::user()->id !== $lancamento->user_id) {
            abort(403, 'Acesso Não Autorizado');
        }

        DB::transaction(function () use ($lancamento) {
            if ($lancamento->meta_id) {
                $this->updateMetaProgress($lancamento->meta, $lancamento->amount, $lancamento->type, true); // Inverte
            }
            $lancamento->delete();
        });

        return redirect()->route('lancamentos.index')->with('success', 'Lançamento excluído com sucesso!');
    }

    private function updateMetaProgress(Meta $meta, $amount, $type, $revert = false)
    {
        if ($type === 'receita') {
            $revert ? $meta->decrement('current_amount', $amount) : $meta->increment('current_amount', $amount);
        } else { // despesa
            $revert ? $meta->increment('current_amount', $amount) : $meta->decrement('current_amount', $amount);
        }
    }
}