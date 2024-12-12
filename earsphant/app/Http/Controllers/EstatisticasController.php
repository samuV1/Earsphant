<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstatisticasController extends Controller
{
    // Exibir Interface de Estatísticas
    public function exibirEstatisticas()
    {
        return view('administrador.estatisticas');
    }
}
