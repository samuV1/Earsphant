<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programa;
use App\Models\Equipamento;
use App\Models\Setor;

class AtivoController extends Controller
{
    // Interface de adição de equipamento
    public function exibirAdicaoEquipamento()
    {
        return view('administrador.adicionarEquipamento');
    }

    // Interface de adição de Programa
    public function exibirAdicaoPrograma()
    {
        return view('administrador.adicionarPrograma');
    }

    // Criar instância na tabela equipamento
    public function armazenarEquipamentoBD(Request $request)
    {
        $request->validate([
            'patrimonio' => 'required',
            'tipo' => 'required',
            'aquisicao' => 'required',
            'alugado' => 'required',
            'marca' => 'nullable',
            'modelo' => 'nullable',
            'fornecedor' => 'nullable',
        ]);
    
        // Criar o equipamento
        Equipamento::create([
            'patrimonio' => $request->patrimonio,
            'tipo' => $request->tipo,
            'aquisicao' => $request->aquisicao,
            'alugado' => $request->alugado,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'fornecedor' => $request->fornecedor,
        ]);
    
        // Retornar uma resposta de sucesso
        return redirect()->back()->with('success', 'Equipamento adicionado com sucesso!');
    }

    // Criar instância na tabela Programa
    public function armazenarProgramaBD(Request $request)
    {
        $request->validate([
        'codigo' => 'required',
        'licenca' => 'nullable',
        'nome' => 'required',
        'fornecedor' => 'nullable',
        'versao' => 'nullable',
        'aquisicao' => 'nullable',
        'terceiros' => 'required',
        ]);
    
        // Criar o Programa
        Programa::create([
        'codigo' => $request->codigo,
        'licenca' => $request->licenca,
        'nome' => $request->nome,
        'fornecedor' => $request->fornecedor,
        'versao' => $request->versao,
        'aquisicao' => $request->aquisicao,
        'terceiros' =>$request->terceiros,
        ]);
    
        // Retornar uma resposta de sucesso
        return redirect()->back()->with('success', 'Programa adicionado com sucesso!');
    }

    public function exibirEditarEquipamento(Equipamento $equipamento)
    {
        $equipamento = Equipamento::where('patrimonio', $equipamento->patrimonio)->firstOrFail();

        return view('administrador.editarEquipamento', compact('equipamento'));
    }

    public function exibirEditarPrograma(Programa $programa)
    {
        $programa = Programa::where('codigo', $programa->codigo)->firstOrFail();

        return view('administrador.editarPrograma', compact('programa'));
    }

     // Método para editar o equipamento
     public function editarEquipamento(Request $request)
     {
         // Validar os dados recebidos do formulário
         $validatedData = $request->validate([
             'patrimonio' => 'required|string|max:255',
             'tipo' => 'required|string|max:255',
             'aquisicao' => 'required|date',
             'alugado' => 'required|in:true,false',
             'marca' => 'required|string|max:255',
             'modelo' => 'required|string|max:255',
             'fornecedor' => 'required|string|max:255',
         ]);
 
         // Procurar o equipamento pelo código ou ID (supondo que o código seja único)
         $equipamento = Equipamento::where('patrimonio', $request->patrimonio)->first();
 
         if ($equipamento) {
             // Atualizar os dados do equipamento
             $equipamento->update([
                 'patrimonio' => $request->patrimonio,
                 'tipo' => $request->tipo,
                 'aquisicao' => $request->aquisicao,
                 'alugado' => $request->alugado,
                 'marca' => $request->marca,
                 'modelo' => $request->modelo,
                 'fornecedor' => $request->fornecedor,
             ]);
 
             // Redirecionar com sucesso
             return redirect()->route('pesquisaEquipamento')->with('success', 'Equipamento atualizado com sucesso!');
         }
 
         // Se o equipamento não for encontrado, redirecionar com erro
         return redirect()->back()->with('error', 'Equipamento não encontrado.');
     }
 
     // Método para remover o equipamento
     public function removerEquipamento(Request $request)
     {
         // Encontrar o equipamento
         $equipamento = Equipamento::where('patrimonio', $request->patrimonio)->first();
 
         if ($equipamento) {
             // Remover o equipamento
             $equipamento->delete();
 
             // Redirecionar com sucesso
             return redirect()->route('pesquisaEquipamento')->with('success', 'Equipamento removido com sucesso!');
         }
 
         // Se o equipamento não for encontrado
         return redirect()->back()->with('error', 'Equipamento não encontrado.');
     }

      // Método para editar o programa
    public function editarPrograma(Request $request)
    {
        // Validar os dados recebidos do formulário
        $validatedData = $request->validate([
            'licenca' => 'required|string|max:255',
            'codigo' => 'required|string|max:255',
            'aquisicao' => 'required|date',
            'terceiros' => 'required|in:true,false',
            'nome' => 'required|string|max:255',
            'fornecedor' => 'required|string|max:255',
            'versao' => 'required|string|max:255',
        ]);

        // Procurar o programa pelo código (ou outro campo, caso necessário)
        $programa = Programa::where('codigo', $request->codigo)->first();

        if ($programa) {
            // Atualizar os dados do programa
            $programa->update([
                'licenca' => $request->licenca,
                'codigo' => $request->codigo,
                'aquisicao' => $request->aquisicao,
                'terceiros' => $request->terceiros,
                'nome' => $request->nome,
                'fornecedor' => $request->fornecedor,
                'versao' => $request->versao,
            ]);

            // Redirecionar com sucesso
            return redirect()->route('pesquisaProgramas')->with('success', 'Programa atualizado com sucesso!');
        }

        // Se o programa não for encontrado, redirecionar com erro
        return redirect()->back()->with('error', 'Programa não encontrado.');
    }

    // Método para remover o programa
    public function removerPrograma(Request $request)
    {
        // Encontrar o programa pelo código
        $programa = Programa::where('codigo', $request->codigo)->first();

        if ($programa) {
            // Remover o programa
            $programa->delete();

            // Redirecionar com sucesso
            return redirect()->route('pesquisaProgramas')->with('success', 'Programa removido com sucesso!');
        }

        // Se o programa não for encontrado
        return redirect()->back()->with('error', 'Programa não encontrado.');
    }
}
