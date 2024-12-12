<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    // exibir a interface de adição de usuário
    public function exibirAdicaoUsuario()
    {
        return view('administrador.adicionarUsuario');
    }

    // criar instância na tabela usuário
    public function armazenarBD(Request $request)
    {
    // Validação dos dados
    $request->validate([
        'nome' => 'required|string|max:255',
        'setor' => 'required|integer|max:255',
        'acesso' => 'required|integer|min:0|max:3',
        'login' => 'required|string|max:255|unique:usuarios,login',
        'senha' => 'required|string',
        'url_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Foto opcional
    ]);


    // Verificar se o arquivo foi enviado
    if ($request->hasFile('url_foto')) {
        // Obter o arquivo
        $arquivo = $request->file('url_foto');

        // Criar um nome único para o arquivo
        $nomeArquivo = time() . '.' . $arquivo->getClientOriginalExtension();

        // Salvar o arquivo localmente na pasta 'storage/app/uploads'
        $caminhoImagem = $arquivo->storeAs('uploads', $nomeArquivo, 'public'); // Usa o disco público
    
        // Criar o usuário no banco de dados

        Usuario::create([
            'nome' => $request->nome,
            'setor' => $request->setor,
            'acesso' => $request->acesso,
            'login' => $request->login,
            'senha' => $request->senha, // Salvar senha criptografada
            'url_foto' => $caminhoImagem, // Caminho do arquivo no servidor
        ]);
        

    }else{

    Usuario::create([
        'nome' => $request->nome,
        'setor' => $request->setor,
        'acesso' => $request->acesso,
        'login' => $request->login,
        'senha' => $request->senha, // Salvar senha criptografada
        'url_foto' => null, // Caminho do arquivo no servidor
    ]);
    }

    // Retornar resposta de sucesso
    return redirect()->back()->with('success', 'Usuário adicionado com sucesso!');
    }

    public function exibirEditarUsuario(Usuario $usuario)
    {
        $usuario = Usuario::where('login', $usuario->login)->firstOrFail();

        return view('administrador.editarUsuario', compact('usuario'));
    }

     // Método para editar o usuário
     public function editarUsuario(Request $request)
     {
         // Validar os dados recebidos do formulário
         $validatedData = $request->validate([
             'nome' => 'required|string|max:255',
             'setor' => 'required|',           
             'acesso' => 'required|in:0,1,2,3',
             'login' => 'required|string|max:255',
             'senha' => 'nullable|string',
             'url_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', // Validação da foto
         ]);
 
         // Encontrar o usuário pelo ID (supondo que o usuário esteja autenticado)
         $usuario = Usuario::where('login', $request->login)->firstOrFail();

 
         if ($usuario) {
             // Atualizar dados do usuário
             $usuario->nome = $request->nome;
             $usuario->setor = $request->setor;
             $usuario->acesso = $request->acesso;
             $usuario->login = $request->login;
             $usuario->senha = $request->senha;
             // Atualizar a senha apenas se foi fornecida

 
             // Verificar se uma nova foto foi enviada
             if ($request->hasFile('url_foto')) {
                 // Remover a foto antiga se houver
                 if ($usuario->url_foto) {
                     Storage::delete('public/' . $usuario->url_foto);
                 }
 
                 // Salvar a nova foto e atualizar a URL
                 $path = $request->file('url_foto')->store('fotos_usuarios', 'public');
                 $usuario->url_foto = $path;
             }
 
             // Salvar as alterações no banco de dados
             $usuario->save();
 
             // Redirecionar com sucesso
             return redirect()->route('pesquisaUsuario')->with('success', 'Usuário atualizado com sucesso!');
         }
 
         // Se o usuário não for encontrado, redirecionar com erro
         return redirect()->back()->with('error', 'Usuário não encontrado.');
     }
 
     // Método para remover o usuário
     public function removerUsuario(Request $request)
     {
         // Encontrar o usuário pelo ID (supondo que o usuário esteja autenticado)
        $usuario = Usuario::where('login', $request->login)->firstOrFail();

 
         if ($usuario) {
             // Remover a foto de perfil se houver
             if ($usuario->url_foto) {
                 Storage::delete('public/' . $usuario->url_foto);
             }
 
             // Remover o usuário
             $usuario->delete();
 
             // Redirecionar com sucesso
             return redirect()->route('pesquisaUsuario')->with('success', 'Usuário removido com sucesso!');
         }
 
         // Se o usuário não for encontrado
         return redirect()->back()->with('error', 'Usuário não encontrado.');
     }
}
