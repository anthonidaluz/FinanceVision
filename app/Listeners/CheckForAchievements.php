<?php

namespace App\Listeners;

use App\Events\LancamentoCreated;
use App\Models\Achievement;
use App\Models\User; // Importe o Model User
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CheckForAchievements
{
    /**
     * Handle the event.
     */
    public function handle(LancamentoCreated $event): void
    {
        $user = $event->lancamento->user;

        // Agora o método handle chama funções específicas para cada conquista
        $this->checkFirstLancamento($user);
        $this->checkTenLancamentos($user);
    }

    /**
     * Verifica a conquista "Início da Jornada".
     */
    private function checkFirstLancamento(User $user): void
    {
        $achievement = Achievement::where('slug', 'primeiro-lancamento')->first();

        if (!$achievement)
            return;

        // O usuário já ganhou esta conquista antes?
        $alreadyHasIt = $user->achievements()->where('achievement_id', $achievement->id)->exists();

        if (!$alreadyHasIt) {
            $user->achievements()->attach($achievement->id);
        }
    }

    /**
     * Verifica a conquista "Pé-quente Financeiro".
     */
    private function checkTenLancamentos(User $user): void
    {
        $achievement = Achievement::where('slug', 'pe-quente-10-lancamentos')->first();

        if (!$achievement)
            return;

        // O usuário já ganhou esta conquista antes?
        $alreadyHasIt = $user->achievements()->where('achievement_id', $achievement->id)->exists();

        // Se o usuário tem 10 ou mais lançamentos E ainda não tem a conquista...
        if ($user->lancamentos()->count() >= 10 && !$alreadyHasIt) {
            $user->achievements()->attach($achievement->id); // Desbloqueia!
        }
    }
}