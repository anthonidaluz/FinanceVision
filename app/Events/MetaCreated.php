<?php

namespace App\Events;

use App\Models\Meta; // <-- Adicione
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MetaCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Meta $meta // <-- Adicione
    ) {
    }
}