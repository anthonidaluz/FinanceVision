<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'amount',
        'type',
        'date',
        'meta_id',
        'category_id', 
    ];

    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }

    // Essencial que este método exista
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}