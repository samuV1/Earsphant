<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Equipamento;
use App\Models\Programa;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Servico;
use App\Models\Setor;

class PesquisaController extends Controller
{
   
    public function pesquisaUsuario(Request $request)
    {
        $usuarios = Usuario::where('nome', 'like', '%'.$request->input('nome').'%')
                            ->where('setor', 'like', '%'.$request->input('setor').'%')
                            ->where('acesso', 'like', '%'.$request->input('acesso').'%')
                            ->where('login', 'like', '%'.$request->input('login').'%')
                            ->get();

        return view('administrador.pesquisaUsuario', ['usuarios' => $usuarios]);
    }

 /*   public function pesquisaAtendimento(Request $request)
    {
        $atendimentos = Atendimento::where('codigo', 'like', '%'.$request->input('codigo').'%')
                    ->where('setor', 'like', '%'.$request->input('setor').'%')
                    ->where('status', 'like', '%'.$request->input('status').'%')
                    ->where('usuario', 'like', '%'.$request->input('usuario').'%')
                    ->where('servico', 'like', '%'.$request->input('servico').'%')
                    ->where('descricao', 'like', '%'.$request->input('descricao').'%')
                    ->get();

        $categorias = Servico::all();
        $equipamentos = Equipamento::all();
        $programas = Programa::all();

        return view('administrador.pesquisaAtendimento', compact('categorias', 'equipamentos', 'programas'), ['atendimentos' => $atendimentos]);
    }*/

    public function pesquisaAtendimento(Request $request)
{
    $query = Atendimento::query();

    // Filtros diretos na tabela 'atendimentos'
    if ($request->filled('codigo')) {
        $query->where('codigo', 'like', '%' . $request->input('codigo') . '%');
    }

    if ($request->filled('setor')) {
        $query->where('setor', 'like', '%' . $request->input('setor') . '%');
    }

    if ($request->filled('status')) {
        $query->where('status', 'like', '%' . $request->input('status') . '%');
    }

    if ($request->filled('usuario')) {
        $query->where('usuario', 'like', '%' . $request->input('usuario') . '%');
    }

    if ($request->filled('servico')) {
        $query->where('servico', 'like', '%' . $request->input('servico') . '%');
    }

    if ($request->filled('descricao')) {
        $query->where('descricao', 'like', '%' . $request->input('descricao') . '%');
    }

    if ($request->filled('equipamento')) {
        $query->where('equipamento', 'like', '%' . $request->input('equipamento') . '%');
    }

    if ($request->filled('programa')) {
        $query->where('programa', 'like', '%' . $request->input('programa') . '%');
    }

    // Obter resultados
    $query->orderBy('abertura', 'desc');

    $atendimentos = $query->get();

    // Carregar categorias, equipamentos e programas
    $categorias = Servico::all();
    $equipamentos = Equipamento::all();
    $programas = Programa::all();

    return view('administrador.pesquisaAtendimento', compact('categorias', 'equipamentos', 'programas'), ['atendimentos' => $atendimentos]);
}

    public function pesquisaEquipamento(Request $request)
    {
        $equipamentos = Equipamento::where('patrimonio', 'like', '%'.$request->input('patrimonio').'%')->where('tipo', 'like', '%'.$request->input('tipo').'%')->where('aquisicao', 'like', '%'.$request->input('aquisicao').'%')->where('alugado', 'like', '%'.$request->input('alugado').'%')->where('marca', 'like', '%'.$request->input('marca').'%')->where('modelo', 'like', '%'.$request->input('modelo').'%')->get();
        
        return view('administrador.pesquisaEquipamento', ['equipamentos' => $equipamentos]);
    }

    public function pesquisaPrograma(Request $request)
    {
        $programas = Programa::where('licenca', 'like', '%'.$request->input('licenca').'%')
                    ->where('codigo', 'like', '%'.$request->input('codigo').'%')
                    ->where('aquisicao', 'like', '%'.$request->input('aquisicao').'%')
                    ->where('terceiros', 'like', '%'.$request->input('terceiros').'%')
                    ->where('nome', 'like', '%'.$request->input('nome').'%')
                    ->where('fornecedor', 'like', '%'.$request->input('fornecedor').'%')
                    ->get();
        
        return view('administrador.pesquisaPrograma', ['programas' => $programas]);
    }

    public function pesquisaSetor(Request $request)
    {
        $setores = Setor::where('codigo', 'like', '%'.$request->input('codigo').'%')
                    ->where('nome', 'like', '%'.$request->input('nome').'%')
                    ->get();
        
        return view('administrador.pesquisaSetor', ['setores' => $setores]);
    }

    public function pesquisaServico(Request $request)
    {
        $servicos = Servico::where('servico', 'like', '%'.$request->input('servico').'%')
                    ->where('status', 'like', '%'.$request->input('status').'%')
                    ->get();
        
        return view('administrador.pesquisaServico', ['servicos' => $servicos]);
    }
}
