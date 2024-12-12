<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AutenticadorController extends Controller
{
    // Exibir tela de autenticação
    public function exibirIndex()
    {
        return view('index');
    }

    // Exibir o index do módulo usuário
    public function exibirInicioUsuario()
    {
        return view('usuario.inicio');
    }

    // Exibir o index do módulo administrador
    public function exibirInicioAdm()
    {
        return redirect()->route('dashboard');
    }

    // Autenticador de usuário
    public function login(Request $request)
    {
        // Validação simples
        $credenciais = $request->validate([
            'login' => 'required|string',
            'senha' => 'required|string',
        ]);

        // Busca o usuário pelo login
        $usuario = Usuario::where('login', $credenciais['login'])->first();

        // Verifica se o usuário existe e a senha está correta
        if ($usuario && ($credenciais['senha'] == $usuario->senha) && ($usuario->acesso == 0)) {
            $request->session()->put('usuario_login', $usuario->login); // Salva o ID do usuário na sessão
            session(['login' => $usuario->login]);
            session(['setor' => $usuario->setor]);
            session(['acesso' => $usuario->acesso]);

            return view('/usuario/inicio');
        }
        if ($usuario && ($credenciais['senha'] == $usuario->senha) && ($usuario->acesso == 1)) {
            $request->session()->put('usuario_login', $usuario->login); // Salva o ID do usuário na sessão
            session(['login' => $usuario->login]);
            session(['setor' => $usuario->setor]);
            session(['acesso' => $usuario->acesso]);

            return redirect()->route('dashboard');
        }
        if ($usuario && ($credenciais['senha'] == $usuario->senha) && ($usuario->acesso == 2)) {
            $request->session()->put('usuario_login', $usuario->login); // Salva o ID do usuário na sessão
            session(['login' => $usuario->login]);
            session(['setor' => $usuario->setor]);
            session(['acesso' => $usuario->acesso]);

            return redirect('/administrador/inicio');
        }
        if ($usuario && ($credenciais['senha'] == $usuario->senha) && ($usuario->acesso == 3)) {
            $request->session()->put('usuario_login', $usuario->login); // Salva o ID do usuário na sessão
            session(['login' => $usuario->login]);
            session(['setor' => $usuario->setor]);
            session(['acesso' => $usuario->acesso]);

            return redirect('/administrador/inicio');
        }

        return back()->withErrors(['error' => 'Login ou senha inválidos'])->withInput();
    }

    // Logout do usuário
    public function logout(Request $request)
    {
        $request->session()->forget('usuario_login');
        return redirect('/');
    }
}
