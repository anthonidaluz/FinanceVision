<?php

namespace App\Events;

use App\Models\User; // <-- Adicione
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReportViewed
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public User $user // <-- Adicione
    ) {
    }
}