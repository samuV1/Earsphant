<?php

use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\AtivoController;
use App\Http\Controllers\AutenticadorController;
use App\Http\Controllers\EstatisticasController;
use App\Http\Controllers\FilasAtendimentosController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PesquisaController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Login e logout
Route::get('/', [AutenticadorController::class, 'exibirIndex'])->name('index');
Route::post('/', [AutenticadorController::class, 'login'])->name('login');
Route::get('/logout', [AutenticadorController::class, 'logout'])->name('logout');
Route::get('/administrador/inicio', [DashboardController::class, 'index'])->name('dashboard');


// Fallback
Route::fallback(function(){
    echo "A página que você que você digitou não existe!";
}); 

// Módulo Usuário

// Interface de início do módulo usuário
Route::get('/usuario/inicio', [AutenticadorController::class, 'exibirInicioUsuario'])->name('inicioUsuario');

// Abrir Atendimento
Route::get('/usuario/abrirAtendimentos', [AtendimentoController::class, 'exibirAbrirAtendimento'])->name('abrirAtendimentos');


// Historicos Atendimentos Fechados
Route::get('/usuario/historico', [HistoricoController::class, 'historico'])->name('tickets.historico');
Route::get('/historico/{codigo}', [HistoricoController::class, 'detalhes'])->name('tickets.detalhes');
Route::get('/historico/historico/{userId?}', [AtendimentoController::class, 'historicoFinalizados'])->name('atendimentos.finalizados');

// Históricos Atendimentos Abertos
Route::get('/usuario/atendimentosAbertos', [AtendimentoController::class, 'exibirAtendimentosAbertos'])->name('atendimentosAbertos');
Route::get('/usuario/atendimentos', [AtendimentoController::class, 'exibirAtendimento'])->name('atendimento');
Route::get('/usuario/atendimentosAbertos', [HistoricoController::class, 'historicoAbertos'])->name('atendimentoHistoricoAberto');

//Atendimentos
Route::get('/usuario/atendimento/{codigo}', [AtendimentoController::class, 'atendimento'])->name('atendimento');
Route::post('usuario/atendimentos', [AtendimentoController::class, 'armazenarBD'])->name('armazenar');
Route::post('/atendimento/{codigo}/nota', [NotaController::class, 'adicaoNotaUsuario'])->name('adicaoNotaUsuario');

// Módulo Administrador

// Interface de início do módulo administrador
Route::get('/administrador/inicios', [AutenticadorController::class, 'exibirInicioAdm'])->name('inicioAdm');

// Interface Adicionar Usuário
Route::get('/administrador/adicionarUsuario', [UsuarioController::class, 'exibirAdicaoUsuario'])->name('adicionarUsuario');
Route::post('/administrador/adicionarUsuario', [UsuarioController::class, 'armazenarBD'])->name('adicionarUsuario');

// Interface Adicionar Ativo
Route::get('/administrador/adicionarEquipamento', [AtivoController::class, 'exibirAdicaoEquipamento'])->name('adicionarEquipamento');
Route::post('/administrador/adicionarEquipamento', [AtivoController::class, 'armazenarEquipamentoBD'])->name('adicionarEquipamento');

Route::get('/administrador/adicionarPrograma', [AtivoController::class, 'exibirAdicaoPrograma'])->name('adicionarPrograma');
Route::post('/administrador/adicionarPrograma', [AtivoController::class, 'armazenarProgramaBD'])->name('adicionarPrograma');

// Interface Adicionar Setor
Route::get('/administrador/adicionarSetor', [SetorController::class, 'exibirAdicaoSetor'])->name('adicionarSetor');
Route::post('/administrador/adicionarSetor', [SetorController::class, 'armazenarBD'])->name('adicionarSetor');

// Interface Adicionar Serviço
Route::get('/administrador/adicionarServico', [ServicoController::class, 'exibirAdicaoServico'])->name('adicionarServico');
Route::post('/administrador/adicionarServico', [ServicoController::class, 'armazenarBD'])->name('adicionarServico');

// Interface Editar Usuário
Route::get('/administrador/editarUsuario/{usuario}', [UsuarioController::class, 'exibirEditarUsuario'])->name('exibirEditarUsuario');
Route::post('/administrador/editarUsuario/', [UsuarioController::class, 'editarUsuario'])->name('editarUsuario');


// Interface Editar Ativo
Route::get('/administrador/editarPrograma/{programa}', [AtivoController::class, 'exibirEditarPrograma'])->name('exibirEditarPrograma');
Route::post('/administador/editarPrograma', [AtivoController::class, 'editarPrograma'])->name('editarPrograma');

Route::get('/administrador/editarEquipamento/{equipamento}', [AtivoController::class, 'exibirEditarEquipamento'])->name('exibirEditarEquipamento');
Route::post('/administrador/editarEquipamento', [AtivoController::class, 'editarEquipamento'])->name('atualizarEquipamento');

// Interface Editar Setor
Route::get('/administrador/editarSetor/{setor}', [SetorController::class, 'exibirEditarSetor'])->name('exibirEditarSetor');
Route::post('/administrador/editarSetor', [SetorController::class, 'editarSetor'])->name('editarSetor');

// Interface Editar Servico
Route::get('/administador/editarServico/{servico}', [ServicoController::class, 'exibireditarServico'])->name('exibirEditarServico');
Route::post('/administador/editarServico', [ServicoController::class, 'editarServico'])->name('editarServico');

// Remover:
Route::post('/administador/removerSetor', [SetorController::class, 'removerSetor'])->name('removerSetor');

Route::post('/administador/removerServico', [ServicoController::class, 'removerServico'])->name('removerServico');

Route::post('/administrador/removerEquipamento', [AtivoController::class, 'removerEquipamento'])->name('removerEquipamento');

Route::post('/administrador/removerPrograma', [AtivoController::class, 'removerPrograma'])->name('removerPrograma');

Route::post('/administrador/removerUsuario', [UsuarioController::class, 'removerUsuario'])->name('removerUsuario');


// Pesquisas
Route::get('/administrador/pesquisaUsuario', [PesquisaController::class, 'pesquisaUsuario'])->name('pesquisaUsuario');
Route::post('/administrador/pesquisaUsuario', [PesquisaController::class, 'pesquisaUsuario'])->name('pesquisaUsuario');

Route::get('/administrador/pesquisaAtendimento', [PesquisaController::class, 'pesquisaAtendimento'])->name('pesquisaAtendimento');
Route::post('/administrador/pesquisaAtendimento', [PesquisaController::class, 'pesquisaAtendimento'])->name('pesquisaAtendimento');


Route::get('/administrador/pesquisaPrograma', [PesquisaController::class, 'pesquisaPrograma'])->name('pesquisaProgramas');
Route::post('/administrador/pesquisaPrograma', [PesquisaController::class, 'pesquisaPrograma'])->name('pesquisaProgramas');

Route::get('/administrador/pesquisaEquipamento', [PesquisaController::class, 'pesquisaEquipamento'])->name('pesquisaEquipamento');
Route::post('/administrador/pesquisaEquipamento', [PesquisaController::class, 'pesquisaEquipamento'])->name('pesquisaEquipamento');

Route::get('/administrador/pesquisaSetor', [PesquisaController::class, 'pesquisaSetor'])->name('pesquisaSetor');
Route::post('/administrador/pesquisaSetor', [PesquisaController::class, 'pesquisaSetor'])->name('pesquisaSetor');

Route::get('/administrador/pesquisaServico', [PesquisaController::class, 'pesquisaServico'])->name('pesquisaServico');
Route::post('/administrador/pesquisaServico', [PesquisaController::class, 'pesquisaServico'])->name('pesquisaServico');

// Abertura de Tickets
Route::get('/administrador/abrirAtendimentoADM', [AtendimentoController::class, 'exibirAbrirAtendimentoADM'])->name('abrirAtendimentoADM');
Route::post('/administrador/abrirAtendimentoADM', [AtendimentoController::class, 'abrirAtendimentoADM'])->name('abrirAtendimentoADM');
Route::post('administrador/atendimento/{codigo}/nota', [NotaController::class, 'adicaoNotaADM'])->name('adicaoNotaADM');

Route::post('/atendimento/{codigo}/assumir', [AtendimentoController::class, 'assumirAtendimento'])
    ->name('assumirAtendimento');

Route::post('/atendimento/{codigo}/escalonar', [AtendimentoController::class, 'escalonamento'])
    ->name('escalonamento');

Route::post('/atendimento/{codigo}/concluir', [AtendimentoController::class, 'concluirAtendimento'])
    ->name('concluirAtendimento');

// Estatísticas

Route::get('/administrador/estatisticas', [EstatisticasController::class, 'exibirEstatisticas'])->name('estatisticas');

// Fila de atendimentos

Route::get('/administrador/filaAtendimentoAberto', [FilasAtendimentosController::class, 'filaAbertos'])->name('filaAtendimentoAbertos');

Route::get('/administrador/filaSetor', [FilasAtendimentosController::class, 'filaSetor'])->name('filaSetor');

Route::get('/administrador/minhaFila', [FilasAtendimentosController::class, 'minhaFila'])->name('minhaFila');

//// testes


Route::get('/administador/atendimento/{codigo}', [AtendimentoController::class, 'atendimentoADM'])->name('atendimentoADM');

Route::post('/administador/atualizarAtendimento/{codigo}', [AtendimentoController::class, 'atualizar'])->name('atualizarAtendimento');
/// ideias






