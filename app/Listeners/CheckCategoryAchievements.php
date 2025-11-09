<?php

namespace App\Listeners;

use App\Events\CategoryCreated;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CheckCategoryAchievements
{
    public function handle(CategoryCreated $event): void
    {
        $user = $event->category->user;
        $categoryCount = $user->categories()->count();

        // BRONZE 2: "Organizador(a)"
        $this->awardAchievement($user, 'organizador-5-categorias', fn() => $categoryCount >= 5);
    }

    /**
     * Função auxiliar reutilizável para conceder uma conquista.
     */
    private function awardAchievement(User $user, string $slug, \Closure $condition): void
    {
        $achievement = Achievement::where('slug', $slug)->first();

        // 1. A conquista existe no banco?
        if (!$achievement) {
            Log::warning("Conquista '{$slug}' não encontrada.");
            return;
        }

        // 2. O utilizador já tem esta conquista?
        if ($user->achievements()->where('achievement_id', $achievement->id)->exists()) {
            return;
        }

        // 3. A condição específica para ganhar foi atendida?
        if ($condition()) {
            $user->achievements()->attach($achievement->id);
            Log::info("Utilizador {$user->id} desbloqueou: {$achievement->name}");

            // ✅ Salva o OBJETO na sessão (não array)
            session()->flash('new_achievement', $achievement);
        }
    }
}