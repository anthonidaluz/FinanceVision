<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Achievement;
use Illuminate\Support\Facades\Schema; // <-- Adicione esta linha

class AchievementSeeder extends Seeder
{
    // Em database/seeders/AchievementSeeder.php
public function run(): void
{
    Achievement::truncate(); 

    Achievement::create([
        'slug' => 'primeiro-lancamento',
        'name' => 'Início da Jornada',
        'description' => 'Você registrou seu primeiro lançamento!',
        'icon' => 'fa-solid fa-flag-checkered',
        'points' => 10,
        'theme' => 'bronze', // <-- TEMA ADICIONADO
    ]);

    Achievement::create([
        'slug' => 'organizador-5-categorias',
        'name' => 'Organizador(a)',
        'description' => 'Criou 5 categorias para seus lançamentos.',
        'icon' => 'fa-solid fa-tags',
        'points' => 20,
        'theme' => 'bronze', // <-- TEMA ADICIONADO
    ]);

    Achievement::create([
        'slug' => 'planejador-3-metas',
        'name' => 'Planejador(a) Mestre',
        'description' => 'Definiu 3 metas financeiras.',
        'icon' => 'fa-solid fa-map-signs',
        'points' => 30,
        'theme' => 'prata', // <-- TEMA ADICIONADO
    ]);
    
    Achievement::create([
        'slug' => 'pe-quente-10-lancamentos',
        'name' => 'Pé-quente Financeiro',
        'description' => 'Registrou 10 lançamentos no total.',
        'icon' => 'fa-solid fa-shoe-prints',
        'points' => 25,
        'theme' => 'prata', // <-- TEMA ADICIONADO
    ]);

    // Exemplo de uma futura conquista de Ouro
    // Achievement::create([
    //     'slug' => 'meta-concluida',
    //     'name' => 'Objetivo Alcançado!',
    //     'description' => 'Você concluiu sua primeira meta financeira.',
    //     'icon' => 'fa-solid fa-star',
    //     'points' => 100,
    //     'theme' => 'ouro', 
    // ]);
}
}