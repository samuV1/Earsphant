<?php

namespace App\Http\Controllers;
use App\Models\Atendimento;
use App\Models\Anexo;
use App\Models\Equipamento;
use App\Models\Servico;
use App\Models\Usuario;
use App\Models\EquipamentoAtendimento;
use App\Models\Programa;
use App\Models\ProgramaAtendimento;
use App\Models\Setor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    // Exibir a interface de abertura de atendimento de solicições no módulo usuário
    public function exibirAbrirAtendimento()
    {
        // Recupera todos os serviços do banco de dados
        $categorias = Servico::all();

        return view('usuario.abrirAtendimento', compact('categorias'));
    }

    // Exibir a interface de abertura de atendimento de solicições no módulo administrador
    public function exibirAbrirAtendimentoADM()
    {
        // Recupera todos os serviços do banco de dados
        $categorias = Servico::all();
    
        return view('administrador.abrirAtendimento', compact('categorias'));
    }

    // Exibir a interface histórico de solicições finalizadas para o usuário
    public function exibirHistorico()
    {
        return view('usuario.historico');
    }

    // Exibir a interface histórico de solicições em atendimento para o usuário
    public function exibirAtendimentosAbertos()
    {
        return view('usuario.atendimentosAbertos');
    }

    // Exibir a interface de detalhes do atendimento
    public function exibirAtendimento()
    {
        return view('usuario.atendimento');
    }

    // Exibir a interface de usuário de detalhes do atendimento com a recuperação de dados do atendimento selecionado
    public function atendimento($codigo)
    {
        // Busca o primeiro atendimento com o código recebido
        $atendimento = Atendimento::where('codigo', $codigo)->firstOrFail();

        // Consulta com JOIN para pegar as notas do atendimento e o autor da nota (usuário)
        $notas = DB::table('notas')
        ->join('usuarios', 'notas.usuario', '=', 'usuarios.login')  // Fazendo JOIN com a tabela 'usuarios'
        ->where('notas.atendimento', '=', $atendimento->codigo)  // Filtra pelo código de atendimento
        ->select('notas.*', 'usuarios.nome as autor')  // Seleciona as colunas necessárias
        ->orderBy('notas.created_at', 'desc')  // Ordena pela data de criação das notas (alterar para o campo de data adequado, se necessário)
        ->paginate(1);  

        return view('usuario.atendimento', compact('atendimento', 'notas'));
    }

    // Exibir a interface de usuário de detalhes do atendimento com a recuperação de dados do atendimento selecionado
    public function atendimentoADM($codigo)
    {
        // Busca o primeiro atendimento com o código recebido
        $atendimento = Atendimento::where('codigo', $codigo)->firstOrFail();
        $setores = Setor::where('codigo', $atendimento->setor)->firstOrFail();

        $servicos = Servico::all();
        $equipamentos = Equipamento::all();
        $programas = Programa::all();


        // Consulta com JOIN para pegar as notas do atendimento e o autor da nota (usuário)
        $notas = DB::table('notas')
        ->join('usuarios', 'notas.usuario', '=', 'usuarios.login')  // Fazendo JOIN com a tabela 'usuarios'
        ->where('notas.atendimento', '=', $atendimento->codigo)  // Filtra pelo código de atendimento
        ->select('notas.*', 'usuarios.nome as autor')  // Seleciona as colunas necessárias
        ->orderBy('notas.created_at', 'desc')  // Ordena pela data de criação das notas (alterar para o campo de data adequado, se necessário)
        ->paginate(1);  

        $anexos = Anexo::where('atendimento', $atendimento->codigo)->get();
    

        return view('administrador.atendimento', compact('atendimento', 'notas', 'servicos', 'setores', 'equipamentos', 'programas', 'anexos'));
    }

    // Criar instância na tabela atenidmento no BD, relacionado a view de abertura de atendimento no módulo usuário
    public function armazenarBD(Request $request)
    {
        // Validar os dados recebidos
        $request->validate([
            'telefone' => 'required', // Validação do campo 'descricao'
            'descricao' => 'required', // Validação do campo 'descricao'
            'servico' => 'required',   // Validação do campo 'servico'
        ], [
            'telefone.required' => 'O campo telefone é obrigatório.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'servico.required' => 'O campo serviço é obrigatório.',
        ]);

        // Criar o atendimento com o código gerado automaticamente
        $codigoAtendimento = Atendimento::gerarCodigoAtendimento();  // Gerar o código incremental

        // Armazena  na variável o login do usuário auteticado.
        $usuarioLogin = session('usuario_login');

        // Recupera o usuário no banco de dados com base no login
        $user = Usuario::where('login', $usuarioLogin)->first();

        if (!$user) {
            return redirect()->back()->with('erro', 'Usuário não encontrado.');
        }

        // Recupera o setor do usuário
        $setor = $user->setor;


        // Criar o atendimento
        $atendimento = Atendimento::create([
            'codigo' => $codigoAtendimento,  // Código gerado
            'descricao' => $request->descricao,  // Descrição do atendimento
            'setor' => $setor,
            'usuario' => $usuarioLogin,
            'servico' => $request->servico,
            'subservico' => null,
            'status' => 'Aberto',
            'fila' => 'Aberto',
            'abertura' => now(),
            'fechamento' => null,
            'prioridade' => 'baixa',
            'ans' => null
        ]);

        // Verificar se o arquivo foi enviado
        if ($request->hasFile('arquivo')) {
            // Obter o arquivo
            $arquivo = $request->file('arquivo');

            // Nome único para o arquivo
            $nomeArquivo = time() . '.' . $arquivo->getClientOriginalExtension();

            // Salvar o arquivo localmente na pasta 'storage/app/uploads'
            $caminhoArquivo = $arquivo->storeAs('uploads', $nomeArquivo, 'local');  // Salva em storage/app/uploads

            // Salvar os dados no banco
            $anexo = Anexo::create([
                'atendimento' => $atendimento->codigo,  // Relaciona o anexo ao atendimento
                'url_arquivo' => $caminhoArquivo,  // Caminho do arquivo no armazenamento
            ]);
        }

        // Retornar uma resposta de sucesso
        return redirect()->back()->with('status', 'Solicitação aberta com sucesso!');
    }

    // Criar instância na tabela atenidmento no BD, relacionado a view de abertura de atendimento no módulo usuário
    public function abrirAtendimentoADM(Request $request)
    {
        // Validar os dados recebidos
        $request->validate([
            'descricao' => 'required', // Validação do campo 'descricao'
            'servico' => 'required',   // Validação do campo 'servico'
        ]);

        // Criar o atendimento com o código gerado automaticamente
        $codigoAtendimento = Atendimento::gerarCodigoAtendimento();  // Gerar o código incremental

        $usuarioLogin = session('usuario_login');

        // Recupera o usuário no banco de dados com base no login
        $user = Usuario::where('login', $usuarioLogin)->first();

        if (!$user) {
            return redirect()->back()->with('erro', 'Usuário não encontrado.');
        }

        // Recupera o setor do usuário
        $setor = $user->setor;


        // Criar o atendimento
        $atendimento = Atendimento::create([
            'codigo' => $codigoAtendimento,  // Código gerado
            'descricao' => $request->descricao,  // Descrição do atendimento
            'setor' =>  $request->setor,
            'usuario' => $request->login,
            'servico' => $request->servico,
            'subservico' =>  $request->subservico,
            'status' => 'Aberto',
            'fila' => 'Aberto',
            'abertura' => now(),
            'fechamento' => null,
            'ans' => null,
            'encarregado' => $usuarioLogin,
            'prioridade' => 'baixa',
            'programa' => null,
            'equipamento' => null,
            
        ]);

        if ($request->hasFile('arquivo')) {
            $arquivo = $request->file('arquivo');
            $nomeArquivo = time() . '.' . $arquivo->getClientOriginalExtension();
        
            // Caminho completo no disco 'public'
            $arquivo->move(storage_path('app/public/uploads'), $nomeArquivo);
        
            $caminhoArquivo = 'uploads/' . $nomeArquivo;
        
            $anexo = Anexo::create([
                'atendimento' => $atendimento->codigo,
                'url_arquivo' => $caminhoArquivo,
            ]);
        }

        // Retornar uma resposta de sucesso
        return redirect()->back()->with('status', 'Solicitação aberta com sucesso!');
    }

    public function escalonamento(Request $request, $codigo)
{
    $atendimento = Atendimento::findOrFail($codigo);
    $atendimento->fila = $request->input('fila');  // Atualiza a fila
    $atendimento->encarregado = null;  
    $atendimento->save();

    return redirect()->route('atendimentoADM', $codigo); // Redireciona para a página de detalhes
}

public function assumirAtendimento(Request $request, $codigo)
{
    

    $atendimento = Atendimento::findOrFail($codigo);
    $atendimento->encarregado = $request->input('encarregado');  // Define o encarregado
    $atendimento->status = 'Em atendimento';
    $atendimento->fila = session('acesso');
    $atendimento->save();

    return redirect()->route('atendimentoADM', $codigo); // Redireciona para a página de detalhes
}

public function concluirAtendimento(Request $request, $codigo)
{
    $atendimento = Atendimento::findOrFail($codigo);
    $atendimento->encarregado = $request->input('encarregado');  // Define o encarregado
    $atendimento->status = 'Fechado';
    $atendimento->fila = 'Finalizados';
    $atendimento->fechamento = now();
    $atendimento->save();

    return redirect()->route('atendimentoADM', $codigo); // Redireciona para a página de detalhes
}

public function atualizar(Request $request, $codigo)
{
    // Valida os dados do formulário
    $validatedData = $request->validate([
        'servico' => 'required|string|max:255',
        'subservico' => 'nullable|string|max:255',
        'prioridade' => 'required|string|in:baixa,normal,alta',
        'equipamento' => 'nullable|string|max:255',
        'programa' => 'nullable|string|max:255',
    ]);

    // Encontra o atendimento pelo código
    $atendimento = Atendimento::where('codigo', $codigo)->firstOrFail();

    // Atualiza os campos editáveis
    $atendimento->servico = $validatedData['servico'];
    $atendimento->subservico = $validatedData['subservico'];
    $atendimento->prioridade = $validatedData['prioridade'];
    $atendimento->equipamento = $validatedData['equipamento'];
    $atendimento->programa = $validatedData['programa'];

    // Salva as alterações no banco de dados
    $atendimento->save();

    // Redireciona de volta com mensagem de sucesso
    return redirect()->route('atendimentoADM', $codigo)->with('success', 'Atendimento atualizado com sucesso!');
}


}
