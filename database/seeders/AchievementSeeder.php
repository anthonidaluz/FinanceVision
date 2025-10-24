<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Achievement;
use Illuminate\Support\Facades\Schema;
class AchievementSeeder extends Seeder
{

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Achievement::truncate();
        Schema::enableForeignKeyConstraints();

        /*
        |--------------------------------------------------------------------------
        | Conquistas de Bronze 🥉 (Iniciação)
        |--------------------------------------------------------------------------
        */
        Achievement::create([
            'slug' => 'primeiro-lancamento',
            'name' => 'Início da Jornada',
            'description' => 'Você registou o seu primeiro lançamento!',
            'icon' => 'fa-solid fa-flag-checkered',
            'points' => 10,
            'theme' => 'bronze',
        ]);

        Achievement::create([
            'slug' => 'organizador-5-categorias',
            'name' => 'Organizador(a)',
            'description' => 'Criou 5 categorias para os seus lançamentos.',
            'icon' => 'fa-solid fa-tags',
            'points' => 20,
            'theme' => 'bronze',
        ]);

        Achievement::create([
            'slug' => 'planejador-3-metas',
            'name' => 'Planejador(a) Mestre',
            'description' => 'Definiu 3 metas financeiras.',
            'icon' => 'fa-solid fa-map-signs',
            'points' => 30,
            'theme' => 'bronze',
        ]);

        Achievement::create([
            'slug' => 'pe-quente-10-lancamentos',
            'name' => 'Pé-quente Financeiro',
            'description' => 'Registou 10 lançamentos no total.',
            'icon' => 'fa-solid fa-shoe-prints',
            'points' => 25,
            'theme' => 'bronze',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Conquistas de Prata 🥈 (Hábito e Exploração)
        |--------------------------------------------------------------------------
        */
        Achievement::create([
            'slug' => 'foco-total-primeira-meta-linkada',
            'name' => 'Foco Total',
            'description' => 'Vinculou um lançamento a uma meta pela primeira vez.',
            'icon' => 'fa-solid fa-link',
            'points' => 20,
            'theme' => 'prata',
        ]);
        Achievement::create([
            'slug' => 'atividade-constante-20-lancamentos',
            'name' => 'Atividade Constante',
            'description' => 'Registou 20 lançamentos no total.',
            'icon' => 'fa-solid fa-file-invoice-dollar',
            'points' => 50,
            'theme' => 'prata',
        ]);
        Achievement::create([
            'slug' => 'o-analista',
            'name' => 'O Analista',
            'description' => 'Gerou seu primeiro relatório financeiro.',
            'icon' => 'fa-solid fa-magnifying-glass-chart',
            'points' => 20,
            'theme' => 'prata',
        ]);
        Achievement::create([
            'slug' => 'sede-de-conhecimento',
            'name' => 'Sede de Conhecimento',
            'description' => 'Visitou a Central de Conhecimento (Dicas).',
            'icon' => 'fa-solid fa-book-open-reader',
            'points' => 15,
            'theme' => 'prata',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Conquistas de Ouro 🥇 (Marcos Reais)
        |--------------------------------------------------------------------------
        */
        Achievement::create([
            'slug' => 'objetivo-alcancado',
            'name' => 'Objetivo Alcançado!',
            'description' => 'Completou a sua primeira meta financeira!',
            'icon' => 'fa-solid fa-trophy',
            'points' => 100,
            'theme' => 'ouro',
        ]);
        Achievement::create([
            'slug' => 'mes-no-verde',
            'name' => 'Mês no Verde',
            'description' => 'Finalizou um mês com mais receitas do que despesas.',
            'icon' => 'fa-solid fa-calendar-check',
            'points' => 75,
            'theme' => 'ouro',
        ]);
    }
}

