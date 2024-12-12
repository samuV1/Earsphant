<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atendimento;
use App\Models\Usuario;

class FilasAtendimentosController extends Controller
{
    // Exibir a fila de solicitações abertas no módulo administrador
    public function filaAbertos()
    {
        // Busca todos os atendimentos com status "Aberto" ordenados pela abertura (mais recentes primeiro)
        $atendimentos = Atendimento::where('status', 'Aberto')
            ->orderBy('abertura', 'desc')
            ->get();

        return view('administrador.filaAtendimentoAberto', compact('atendimentos'));
    }

    // Exibir a fila de solicitações do mesmo nível de acesso usuário 
    public function filaSetor()
    {
        $usuarioLogin = session('usuario_login');

        // Recupera o usuário no banco de dados com base no login
        $user = Usuario::where('login', session('login'))->first();

        if (!$user) {
            return redirect()->back()->with('erro', 'Usuário não encontrado.');
        }

        // Recupera o setor do usuário
        $setor = $user->acesso;

        // Busca todos os atendimentos do setor ordenados pela abertura (mais recentes primeiro)
        $atendimentos = Atendimento::where('fila', $setor)
            ->orderBy('abertura', 'desc')
            ->get();

        return view('administrador.filaSetor', compact('atendimentos'));
    }

    // Exibir a fila de solicitações em que o agente atual é o encarregado
    public function minhaFila()
    {
        $usuarioLogin = session('login');

        // Busca todos os atendimentos em que o agente atual é o encarregado, ordenados pela abertura (mais recentes primeiro)
        $atendimentos = Atendimento::where('encarregado', 'like', (string)$usuarioLogin)
            ->orderBy('abertura', 'desc')
            ->get();

        return view('administrador.minhaFila', compact('atendimentos'));
    }

    
}
