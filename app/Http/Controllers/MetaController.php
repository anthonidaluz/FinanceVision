<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // No topo do arquivo, adicione:


    // ...

    // Substitua o método index() existente por este:
    public function index(Request $request)
    {
        // 1. Pega os valores dos filtros da URL (ou usa null se não existirem)
        $statusFilter = $request->query('status');
        $sortOrder = $request->query('sort');

        // 2. Inicia a consulta e aplica os scopes
        $metas = Auth::user()->metas()
            ->ofStatus($statusFilter) // Aplica o filtro de status
            ->sortBy($sortOrder)     // Aplica a ordenação
            ->get();

        // 3. Envia os dados e os filtros selecionados de volta para a view
        return view('metas.index', [
            'metas' => $metas,
            'selectedStatus' => $statusFilter,
            'selectedSort' => $sortOrder,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('metas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0.01',
            'target_date' => 'nullable|date',
        ]);

        Auth::user()->metas()->create($validated);

        return redirect()->route('metas.index')->with('success', 'Nova meta criada com sucesso!');
    }

    /**
     * Display the specified resource.
     * (We are not using this one for now)
     */
    public function show(Meta $meta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meta $meta)
    {
        if (Auth::user()->id !== $meta->user_id) {
            abort(403);
        }

        return view('metas.edit', ['meta' => $meta]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meta $meta)
    {
        if (Auth::user()->id !== $meta->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0.01',
            'target_date' => 'nullable|date',
        ]);

        $meta->update($validated);

        return redirect()->route('metas.index')->with('success', 'Meta atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meta $meta)
    {
        if (Auth::user()->id !== $meta->user_id) {
            abort(403);
        }

        $meta->delete();

        return redirect()->route('metas.index')->with('success', 'Meta excluída com sucesso!');
    }
}