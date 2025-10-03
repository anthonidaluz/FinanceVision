<?php

namespace App\Listeners;

use App\Events\CategoryCreated;
use App\Models\Achievement;

class CheckCategoryAchievements
{
    public function handle(CategoryCreated $event): void
    {
        $user = $event->category->user;
        $achievement = Achievement::where('slug', 'organizador-5-categorias')->first();

        if (!$achievement)
            return; // Se a conquista não existe, não faz nada

        // O usuário já tem essa conquista?
        $alreadyHasIt = $user->achievements()->where('achievement_id', $achievement->id)->exists();

        // Se o usuário tem 5 ou mais categorias E ainda não tem a conquista...
        if ($user->categories()->count() >= 5 && !$alreadyHasIt) {
            $user->achievements()->attach($achievement->id); // Desbloqueia!
        }
    }
}