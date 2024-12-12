<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atendimento;

class HistoricoController extends Controller
{

    // Lista de atendimentos finalizados do usuário logado
    public function historico()
    {
        // Obtém o login do usuário logado na sessão
        $loginUsuario = session('login'); // Verifique se o login está armazenado na sessão

        // Busca os atendimentos do usuário com status "Finalizado"
        $atendimentos = Atendimento::where('usuario', $loginUsuario)
                                   ->where('status', 'Finalizado')
                                   ->get();

        return view('usuario.historico', compact('atendimentos'));
    }

    public function historicoAbertos()
    {
        // Obtém o login do usuário logado na sessão
        $loginUsuario = session('login'); // Verifique se o login está armazenado na sessão

        // Busca os atendimentos do usuário com status "Finalizado"
        $atendimentos = Atendimento::where('usuario', $loginUsuario)
                                   ->where('status', "!=" , 'Finalizado')
                                   ->get();

        return view('usuario.atendimentosAbertos', compact('atendimentos'));
    }
}
