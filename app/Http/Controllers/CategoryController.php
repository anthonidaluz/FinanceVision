<?php

namespace App\Http\Controllers;

use App\Events\CategoryCreated; // Importa a classe do nosso evento
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
        $categories = Auth::user()->categories()
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
     * Armazena uma nova categoria e dispara o evento de criação.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        // Cria a categoria usando o relacionamento, que é a forma mais limpa e segura
        $category = Auth::user()->categories()->create($validated);

        // ### ATUALIZAÇÃO PRINCIPAL ###
        // Dispara o evento, "anunciando" que uma nova categoria foi criada.
        // O nosso Listener de conquistas vai "ouvir" este anúncio.
        CategoryCreated::dispatch($category);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Exibe o formulário de edição da categoria.
     */
    public function edit(Category $categoria)
    {
        $this->authorizeAccess($categoria);

        return view('categorias.edit', ['category' => $categoria]);
    }

    /**
     * Atualiza os dados da categoria.
     */
    public function update(Request $request, Category $categoria)
    {
        $this->authorizeAccess($categoria);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        $categoria->update($validated);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove a categoria do banco de dados.
     */
    public function destroy(Category $categoria)
    {
        $this->authorizeAccess($categoria);

        $categoria->delete();

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
            abort(403);
        }
    }
}