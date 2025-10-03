<?php

namespace App\Listeners;

use App\Events\MetaCreated;
use App\Models\Achievement;

class CheckMetaAchievements
{
    public function handle(MetaCreated $event): void
    {
        $user = $event->meta->user;
        $achievement = Achievement::where('slug', 'planejador-3-metas')->first();

        if (!$achievement)
            return;

        $alreadyHasIt = $user->achievements()->where('achievement_id', $achievement->id)->exists();

        // Se o usuário tem 3 ou mais metas E ainda não tem a conquista...
        if ($user->metas()->count() >= 3 && !$alreadyHasIt) {
            $user->achievements()->attach($achievement->id); // Desbloqueia!
        }
    }
}