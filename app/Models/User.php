<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function lancamentos()
    {
        return $this->hasMany(Lancamento::class);
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievement')->withTimestamps();
    }

    public function metas()
    {
        return $this->hasMany(Meta::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'user_id');
    }

    // Soma dos pontos de todas as conquistas do usuário
    public function getTotalAchievementPointsAttribute()
    {
        return $this->achievements()->sum('points');
    }

    // Define o nível com base nos pontos acumulados
    public function getLevelAttribute()
    {
        $levels = [
            1 => 0,
            2 => 100,
            3 => 270,
            4 => 520,
        ];
        $points = $this->total_achievement_points;

        foreach (array_reverse($levels, true) as $level => $min) {
            if ($points >= $min) {
                return $level;
            }
        }
        return 1;
    }

    public function getLevelProgressAttribute()
    {
        $levels = [
            1 => 0,
            2 => 100,
            3 => 270,
            4 => 520,
        ];
        $points = $this->total_achievement_points;
        $level = $this->level;

        if ($level == max(array_keys($levels)))
            return 100;

        $nextLevel = $level + 1;
        $currentMin = $levels[$level];
        $nextMin = $levels[$nextLevel];

        $progress = ($points - $currentMin) / ($nextMin - $currentMin) * 100;
        return round(max(0, min(100, $progress)), 1);
    }

    public function getLevelColorAttribute(): string
    {
        return match ($this->level) {
            1 => '#3498db', // Azul (nível 1)
            2 => '#e67e22', // Laranja (nível 2 - bronze)
            3 => '#95a5a6', // Cinza (nível 3 - prata)
            4 => '#ffd700', // Dourado (nível 4 - ouro)
            default => '#bdc3c7', // Cor neutra para níveis indefinidos
        };
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
