<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaController extends Controller
{

    // Em app/Http/Controllers/MetaController.php
    public function index(Request $request)
    {
        $statusFilter = $request->query('status');
        $sortOrder = $request->query('sort');

        $metas = Auth::user()->metas()
            ->withCount('lancamentos') // <-- A MÁGICA ACONTECE AQUI
            ->ofStatus($statusFilter)
            ->sortBy($sortOrder)
            ->get();

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
    // Em app/Http/Controllers/MetaController.php
    public function destroy(Meta $meta)
    {
        if ($meta->user_id !== Auth::id()) {
            abort(403);
        }

        // VERIFICAÇÃO: A meta tem lançamentos associados?
        // O método lancamentos() é o relacionamento que precisamos definir no Model.
        if ($meta->lancamentos()->count() > 0) {
            // Se tiver, volta para a página anterior com uma mensagem de erro.
            return back()->with('error', 'Esta meta não pode ser excluída, pois está vinculada a um ou mais lançamentos.');
        }

        $meta->delete();

        return redirect()->route('metas.index')->with('success', 'Meta excluída com sucesso!');
    }
}