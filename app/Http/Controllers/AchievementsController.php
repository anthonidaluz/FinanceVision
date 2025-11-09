<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchievementsController extends Controller
{
    public function index(Request $request)
    {
        $theme = $request->input('theme');

        // Relação achievements do usuário logado
        $query = Auth::user()->achievements();

        // Aplica o filtro corretamente, com prefixo da tabela
        if (in_array($theme, ['bronze', 'prata', 'ouro'])) {
            $query->where('achievements.theme', $theme);
        }

        // Ordena pelo registro mais recente do pivot
        $achievements = $query
            ->orderByDesc('user_achievements.created_at')
            ->get();

        return view('conquistas.index', compact('achievements'));
    }
}
