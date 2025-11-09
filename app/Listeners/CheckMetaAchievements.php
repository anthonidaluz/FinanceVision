<?php

namespace App\Listeners;

use App\Events\MetaCreated;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CheckMetaAchievements
{
    public function handle(MetaCreated $event): void
    {
        $user = $event->meta->user;
        $metaCount = $user->metas()->count();

        // BRONZE 3: "Planejador(a) Mestre"
        $this->awardAchievement($user, 'planejador-3-metas', fn() => $metaCount >= 3);
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