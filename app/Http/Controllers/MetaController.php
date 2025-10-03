<?php

namespace App\Http\Controllers;

use App\Events\MetaCreated; 
use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaController extends Controller
{


    public function index(Request $request)
    {
        // CORREÇÃO: Renomeado para corresponder ao que a view e o compact() esperam
        $selectedStatus = $request->query('status');
        $selectedSort = $request->query('sort');

        $metas = Auth::user()->metas()
            ->withCount('lancamentos')
            ->ofStatus($selectedStatus) 
            ->sortBy($selectedSort)    
            ->get();

        return view('metas.index', compact(
            'metas',
            'selectedStatus',
            'selectedSort'
        ));
    }

    public function create()
    {
        return view('metas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0.01',
            'target_date' => 'nullable|date',
        ]);

        $meta = Auth::user()->metas()->create($validated);

        // ADICIONADO: Dispara o evento para o sistema de gamificação
        MetaCreated::dispatch($meta);

        return redirect()->route('metas.index')->with('success', 'Nova meta criada com sucesso!');
    }

    public function show(Meta $meta)
    {
        //
    }

    public function edit(Meta $meta)
    {
        if ($meta->user_id !== Auth::id()) {
            abort(403);
        }
        return view('metas.edit', compact('meta'));
    }

    public function update(Request $request, Meta $meta)
    {
        if ($meta->user_id !== Auth::id()) {
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

    public function destroy(Meta $meta)
    {
        if ($meta->user_id !== Auth::id()) {
            abort(403);
        }

        if ($meta->lancamentos()->count() > 0) {
            return back()->with('error', 'Esta meta não pode ser excluída, pois está vinculada a um ou mais lançamentos.');
        }

        $meta->delete();
        return redirect()->route('metas.index')->with('success', 'Meta excluída com sucesso!');
    }
}