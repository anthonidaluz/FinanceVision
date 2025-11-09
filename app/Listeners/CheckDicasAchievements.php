<?php

namespace App\Listeners;

use App\Events\DicasViewed;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CheckDicasAchievements
{
    /**
     * Handle the event.
     */
    public function handle(DicasViewed $event): void
    {
        // A lógica principal agora é só chamar a função auxiliar
        $this->awardAchievement($event->user, 'sede-de-conhecimento', fn() => true);
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

        // 2. O usuário já tem esta conquista?
        if ($user->achievements()->where('achievement_id', $achievement->id)->exists()) {
            return;
        }

        // 3. A condição específica para ganhar foi atendida?
        if ($condition()) {
            $user->achievements()->attach($achievement->id);
            Log::info("Usuário {$user->id} desbloqueou: {$achievement->name}");

            // ✅ Salva o OBJETO na sessão (não array)
            session()->now('new_achievement', $achievement);
        }
    }
}