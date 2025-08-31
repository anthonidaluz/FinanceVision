<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LancamentoController extends Controller
{
    /**
     * Mostra uma lista de todos os lançamentos do usuário.
     */
    public function index()
    {
        // Busca os lançamentos do usuário logado, ordenados pela data mais recente
        $lancamentos = Auth::user()->lancamentos()->latest('date')->get();

        // Retorna a view 'lancamentos.blade.php' e passa a lista de lançamentos para ela
        return view('lancamentos', [
            'lancamentos' => $lancamentos
        ]);
    }

    /**
     * Salva um novo lançamento no banco de dados.
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados que vieram do formulário
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:receita,despesa', // Garante que o valor seja 'receita' ou 'despesa'
            'date' => 'required|date',
        ]);

        // 2. Cria o lançamento, já associando ao usuário que está logado
        Auth::user()->lancamentos()->create($validated);

        // 3. Redireciona de volta para a página de lançamentos com uma mensagem de sucesso
        return redirect()->route('lancamentos.index')->with('success', 'Lançamento adicionado com sucesso!');
    }

    
}