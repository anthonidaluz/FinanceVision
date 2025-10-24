<?php

namespace App\Http\Controllers;

use App\Events\DicasViewed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Exibe a página de Dicas e dispara o evento de conquista.
     */
    public function dicas()
    {
        // Dispara o evento apenas uma vez
        // (O Listener garantirá que a conquista seja concedida apenas na primeira vez)
        DicasViewed::dispatch(Auth::user());

        return view('dicas');
    }
}