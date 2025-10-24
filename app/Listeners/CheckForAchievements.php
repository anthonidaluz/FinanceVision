<?php

namespace App\Listeners;

use App\Events\LancamentoCreated;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CheckForAchievements
{
    public function handle(LancamentoCreated $event): void
    {
        $user = $event->lancamento->user;
        $lancamentoCount = $user->lancamentos()->count();

        // --- BRONZE ---
        // Conquista: 1º Lançamento
        $this->awardAchievement($user, 'primeiro-lancamento', fn() => $lancamentoCount === 1);

        // Conquista: 10 Lançamentos
        $this->awardAchievement($user, 'pe-quente-10-lancamentos', fn() => $lancamentoCount >= 10);

        // --- PRATA ---
        // Conquista: Vinculou 1º Lançamento à Meta
        if ($event->lancamento->meta_id) {
            $this->awardAchievement($user, 'foco-total-primeira-meta-linkada', fn() => true);
        }

        // Conquista: 20 Lançamentos
        $this->awardAchievement($user, 'atividade-constante-20-lancamentos', fn() => $lancamentoCount >= 20);
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