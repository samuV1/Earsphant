<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;

class SetorController extends Controller
{
    // Exibir interface de adição de setor
    public function exibirAdicaoSetor()
    {
        return view('administrador.adicionarSetor');
    }

    // Exibir interface de ediçao de setor
    public function exibirEditarSetor(Setor $setor)
    {
        $setor = Setor::where('codigo', $setor->codigo)->firstOrFail();

        return view('administrador.editarSetor', compact('setor'));
    }

    // criar instância na tabela setor 
    public function armazenarBD(Request $request)
    {
        // Validar os dados
        $request->validate([
            'nome' => 'required|string|max:255',  // Nome do setor deve ser uma string e obrigatório
            'codigo' => 'required|integer|unique:setores,codigo', // Código do setor deve ser único e inteiro
        ]);

        // Criar o novo setor e armazená-lo no banco
        Setor::create([
            'nome' => $request->nome,
            'codigo' => $request->codigo,
        ]);

        // Redirecionar de volta com uma mensagem de sucesso
        return redirect()->route('adicionarSetor')->with('success', 'Setor adicionado com sucesso!');
    }

        // Método para editar o setor
        public function editarSetor(Request $request)
        {
            // Validar os dados do formulário (opcional, mas recomendado)
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'codigo' => 'required|integer',
            ]);
    
            // Encontrar o setor pelo ID ou outro critério (como 'codigo')
            $setor = Setor::find($request->codigo); // Certifique-se de que 'id' está sendo passado no formulário ou na rota
    
            if (!$setor) {
                return redirect()->back()->with('error', 'Setor não encontrado.');
            }
    
            // Atualizar as informações do setor
            $setor->nome = $request->name;
            $setor->codigo = $request->codigo;
            $setor->save();
    
            // Redirecionar para uma página de sucesso ou lista de setores
            return redirect()->route('pesquisaSetor')->with('success', 'Setor atualizado com sucesso!');
        }
    
        // Método para remover o setor
        public function removerSetor(Request $request)
        {
            // Encontrar o setor pelo ID ou outro critério (como 'codigo')
            $setor = Setor::find($request->codigo); // Certifique-se de que 'id' está sendo passado no formulário ou na rota
    
            if (!$setor) {
                return redirect()->back()->with('error', 'Setor não encontrado.');
            }
    
            $setor->delete();
    
            return redirect()->route('pesquisaSetor')->with('success', 'Setor removido com sucesso!');
        }
}
