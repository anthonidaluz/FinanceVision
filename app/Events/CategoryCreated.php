<?php

namespace App\Events;

use App\Models\Category; // <-- Adicione
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CategoryCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Category $category // <-- Adicione
    ) {
    }
}