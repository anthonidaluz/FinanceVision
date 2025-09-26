<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // No futuro, passaremos dados para a view de relatórios aqui.
        // A view precisa estar em resources/views/relatorios/index.blade.php
        return view('relatorios.index');
    }
}