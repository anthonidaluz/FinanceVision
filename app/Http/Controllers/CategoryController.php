<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Exibe todas as categorias do usuário logado.
     */
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())
            ->withCount('lancamentos')
            ->latest()
            ->get();

        return view('categorias.index', compact('categories'));
    }

    /**
     * Exibe o formulário de criação de categoria.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Armazena uma nova categoria vinculada ao usuário logado.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        Category::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Exibe o formulário de edição da categoria.
     */
    public function edit(Category $category)
    {
        $this->authorizeAccess($category);

        return view('categorias.edit', compact('category'));
    }

    /**
     * Atualiza os dados da categoria.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorizeAccess($category);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        $category->update($validated);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove a categoria do banco de dados.
     */
    public function destroy(Category $category)
    {
        $this->authorizeAccess($category);

        $category->delete();

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }

    /**
     * Verifica se o usuário tem permissão para acessar a categoria.
     */
    protected function authorizeAccess(Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para acessar esta categoria.');
        }
    }
}