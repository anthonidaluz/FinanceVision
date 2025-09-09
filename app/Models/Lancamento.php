<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'amount',
        'type',
        'date',
        'meta_id',
    ];

    /**
     * Get the meta that owns the lancamento.
     */
    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }
}