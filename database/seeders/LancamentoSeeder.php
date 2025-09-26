<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Lancamento;
use Carbon\Carbon;

class LancamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria um usuário de teste
        $user = User::factory()->create([
            'name' => 'Usuário Teste',
            'email' => 'teste@email.com',
        ]);

        // Cria algumas categorias para este usuário
        $categorias = collect([
            ['name' => 'Salário', 'icon' => 'fa-solid fa-dollar-sign', 'color' => '#2ecc71'],
            ['name' => 'Alimentação', 'icon' => 'fa-solid fa-burger', 'color' => '#e74c3c'],
            ['name' => 'Transporte', 'icon' => 'fa-solid fa-car', 'color' => '#3498db'],
            ['name' => 'Lazer', 'icon' => 'fa-solid fa-film', 'color' => '#9b59b6'],
            ['name' => 'Moradia', 'icon' => 'fa-solid fa-house-chimney', 'color' => '#f1c40f'],
        ])->map(fn ($cat) => Category::create(array_merge($cat, ['user_id' => $user->id])))
          ->all();

        // Gera lançamentos para os últimos 6 meses
        for ($i = 0; $i < 6; $i++) {
            $date = Carbon::now()->subMonths($i);

            // Cria uma receita de salário
            Lancamento::create([
                'user_id' => $user->id,
                'category_id' => $categorias[0]->id, // Salário
                'description' => 'Salário Mensal',
                'amount' => rand(3000, 5000),
                'type' => 'receita',
                'date' => $date->startOfMonth(),
            ]);

            // Cria de 5 a 10 despesas aleatórias no mês
            for ($j = 0; $j < rand(5, 10); $j++) {
                $randomCategory = $categorias[rand(1, 4)]; // Pega uma categoria de despesa aleatória
                Lancamento::create([
                    'user_id' => $user->id,
                    'category_id' => $randomCategory->id,
                    'description' => 'Compra em ' . $randomCategory->name,
                    'amount' => rand(20, 300),
                    'type' => 'despesa',
                    'date' => $date->day(rand(2, 28)),
                ]);
            }
        }
    }
}