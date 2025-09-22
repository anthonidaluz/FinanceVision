<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Meta extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Define quais campos podem ser preenchidos em massa.
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'target_amount',
        'target_date',
    ];

    public function lancamentos()
    {
        return $this->hasMany(Lancamento::class);
    }
    /**
     * The attributes that should be cast.
     * Garante que os valores sejam sempre tratados com o tipo correto.
     * @var array
     */
    protected $casts = [
        'target_amount' => 'float',
        'current_amount' => 'float',
        'target_date' => 'date',
    ];

    /**
     * Define o relacionamento: uma Meta pertence a um Usuário.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calcula dinamicamente o progresso da meta como uma porcentagem.
     */
    public function getProgressAttribute(): float
    {
        if ($this->target_amount == 0) {
            return 100.0;
        }
        $progress = ($this->current_amount / $this->target_amount) * 100;
        return round(min($progress, 100), 2);
    }

    /**
     * Scope para filtrar metas pelo status (Em Progresso, Concluídas, Atrasadas).
     */
    public function scopeOfStatus(Builder $query, ?string $status): void
    {
        if ($status === 'completed') {
            $query->whereRaw('current_amount >= target_amount');
        } elseif ($status === 'progress') {
            $query->whereRaw('current_amount < target_amount')
                ->where(fn($q) => $q->where('target_date', '>=', now())->orWhereNull('target_date'));
        } elseif ($status === 'overdue') {
            $query->whereRaw('current_amount < target_amount')
                ->where('target_date', '<', now());
        }
    }

    /**
     * Scope para ordenar as metas.
     */
    public function scopeSortBy(Builder $query, ?string $sort): void
    {
        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'closest_due_date') {
            $query->orderBy('target_date', 'asc');
        } else {
            $query->latest();
        }
    }
}