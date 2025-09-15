<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'description',
        'amount',
        'type',
        'date',
        'meta_id',
        'category_id', // <-- Adicionado
    ];

    /**
     * Get the meta that the lancamento belongs to.
     */
    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }

    /**
     * Get the category that the lancamento belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}