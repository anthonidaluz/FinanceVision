<?php

namespace App\Listeners;

use App\Events\MetaCompleted;
use App\Models\Achievement;
use Illuminate\Support\Facades\Log;

class AwardGoalCompletionAchievement
{
    public function handle(MetaCompleted $event): void
    {
        $user = $event->user;

        // Busca a conquista pelo slug
        $achievement = Achievement::where('slug', 'objetivo-alcancado')->first();

        if (!$achievement) {
            Log::warning("Conquista 'objetivo-alcancado' não encontrada.");
            return;
        }

        // Verifica se o usuário já possui a conquista
        $alreadyHasIt = $user->achievements()
            ->where('achievement_id', $achievement->id)
            ->exists();

        if (!$alreadyHasIt) {
            // Concede a conquista
            $user->achievements()->attach($achievement->id);
            Log::info("Usuário {$user->id} desbloqueou: {$achievement->name}");

            // ✅ Salva o OBJETO na sessão (não array)
            // Como há redirect após salvar lançamento/meta, use flash
            session()->flash('new_achievement', $achievement);
        }
    }
}