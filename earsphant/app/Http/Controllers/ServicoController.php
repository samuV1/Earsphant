<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;


class ServicoController extends Controller
{
    // exibir interface de adição de serviço
    public function exibirAdicaoServico()
    {
        return view('administrador.adicionarServico');
    }

    // criar instância na tabela serviços
    public function armazenarBD(Request $request)
    {
        // Validar os dados
        $request->validate([
            'servico' => 'required|string|max:255',  // Nome do setor deve ser uma string e obrigatório
        ]);

        $status = "ativos";

        // Criar o novo setor e armazená-lo no banco
        Servico::create([
            'servico' => $request->servico,
            'ans' => $request->ans,
            'status' => $status,
        ]);

        // Redirecionar de volta com uma mensagem de sucesso
        return redirect()->route('adicionarServico')->with('success', 'Servico adicionado com sucesso!');
    }

    public function exibirEditarServico(Servico $servico)
    {
        $servico = Servico::where('servico', $servico->servico)->firstOrFail();

        return view('administrador.editarServico', compact('servico'));
    }

    // Método para editar o serviço
    public function editarServico(Request $request)
    {
        // Validar os dados do formulário
        $validated = $request->validate([
            'servico' => 'required|string|max:255',
            'ans' => 'required',
            'status' => 'required|in:ativo,obsoleto',
        ]);

        // Encontrar o serviço pelo ID
        $servico = Servico::where('servico', $request->servico)->first();

        if (!$servico) {
            return redirect()->back()->with('error', 'Serviço não encontrado.');
        }

        // Atualizar as informações do serviço
        $servico->servico = $request->servico;
        $servico->ans = $request->ans;
        $servico->status = $request->status;
        $servico->save();

        // Redirecionar para uma página de sucesso ou lista de serviços
        return redirect()->route('pesquisaServico')->with('success', 'Serviço atualizado com sucesso!');
    }

    // Método para remover o serviço
    public function removerServico(Request $request)
    {
        $servico = Servico::where('servico', $request->servico)->first();

        if (!$servico) {
            return redirect()->back()->with('error', 'Serviço não encontrado.');
        }

        $servico->delete();

        return redirect()->route('pesquisaServico')->with('success', 'Serviço removido com sucesso!');
    }
}
