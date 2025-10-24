<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'name',
        'description',
        'icon',
        'points',
        'theme', 
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievement')->withTimestamps();
    }
}