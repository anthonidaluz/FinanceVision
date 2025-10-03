<?php

namespace App\Events;

use App\Models\Lancamento; 
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LancamentoCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Lancamento $lancamento 
    ) {
    }
}