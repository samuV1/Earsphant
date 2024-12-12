@extends('base')

@section('titles', 'Detalhes')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/atendimento.css') }}>
@endsection

@section('pagina')

    @include('administrador.cabecalho')
    
    <main class="elemento_pai">
    
        <h1>Detalhes do Atendimento</h1>

        <form id="atualizarAtendimento" action="{{route('atualizarAtendimento', $atendimento->codigo)}}" method="post">
            @csrf
        <div>
            <section>      
                <label class="label" for="codigo"><strong>Código:</strong></label>
                <input type="text" id="codigo" name="codigo" value="{{ $atendimento->codigo }}" readonly>

                <label for="servico">Serviço:</label>
                    <select name="servico" id="servico">
                        @foreach ($servicos as $servico)
                        <option value="{{ $servico->servico }}" @if($atendimento->servico == $servico->servico) selected @endif>
                            {{ $servico->servico }}
                        </option>
                        @endforeach
                    </select>

                <label class="label" for="subservico"><strong>Subserviço:</strong></label>
                <input type="text" id="subservico" name="subservico" value="{{ $atendimento->subservico}}">

                <label class="label" for="status"><strong>Status:</strong></label>
                <input type="text" id="status" name="status" value="{{ $atendimento->status }}" readonly>

                <label class="label" for="abertura"><strong>Abertura:</strong></label>
                <input type="text" id="abertura" name="abertura" value="{{ $atendimento->abertura }}" readonly>
            
                <label class="label" for="fechamento"><strong>Fechamento:</strong></label>
                <input type="text" id="fechamento" name="fechamento" value="{{ $atendimento->fechamento ?? 'Não finalizado' }}" readonly>

                <label class="label" for="ans"><strong>ANS:</strong></label>
                <input type="text" id="ans" name="ans" value="{{ $servico->ans ?? 'Não se aplica' }}" readonly>     
                </section>
                <section>
                <label class="label" for="usuario"><strong>Login:</strong></label>
                <input type="text" id="usuario" name="usuario" value="{{ $atendimento->usuario }}" readonly>

                <label class="label" for="setor"><strong>Setor:</strong></label>
                <input type="text" id="setor" name="setor" value="{{ $setores->nome}}" readonly>

                <label class="label" for="encarregado"><strong>Encarregado:</strong></label>
                <input type="text" id="encarregado" name="encarregado" value="{{ $atendimento->encarregado }}" readonly>

                <label class="label" for="prioridade"><strong>Prioridade:</strong></label>
                    <select class="dropdown" name="prioridade" id="prioridade" required>
                        <option value="baixa" {{ $atendimento->prioridade == 'baixa' ? 'selected' : '' }}>Baixa</option>
                        <option value="normal" {{ $atendimento->prioridade == 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="alta" {{ $atendimento->prioridade == 'alta' ? 'selected' : '' }}>Alta</option>
                    </select>

                <label for="equipamento">Equipamento:</label>
                    <select name="equipamento" id="equipamento">
                        <option value="">Selecione</option>
                        @foreach ($equipamentos as $equipamento)
                        <option value="{{ $equipamento->patrimonio }}" @if($atendimento->equipamento == $equipamento->patrimonio) selected @endif>
                            {{ $equipamento->patrimonio }}
                        </option>
                        @endforeach
                    </select>

                <label for="programa">Programa:</label>
                <select name="programa" id="programa">
                    <option value="">Selecione</option>
                    @foreach ($programas as $programa)
                        <option value="{{ $programa->codigo }}" @if($atendimento->programa == $programa->codigo) selected @endif>
                            {{ $programa->nome }}
                        </option>
                    @endforeach
                </select>
                @if($atendimento->fechamento == null) 
                <div class="botao-container">
                    <button type="submit" class="botao_paginacao">Alterar</button>
                    <button type="reset" class="botao_paginacao">Resetar</button>
                </div>
                @endif
            </section>
        </form>
            <section>

                <label class="etiqueta" for="descricao"><strong>Descrição:</strong></label>
                <textarea id="descricao" name="descricao" rows="7" cols="40" readonly>{{ $atendimento->descricao }}</textarea><br>

                <label class="etiqueta" for="notas"><strong>Notas:</strong></label>
                <div class="conteiner_notas">
                    @if(count($notas) > 0)
                        @foreach($notas as $nota)
                        <div class="nota-item">
                            <div><strong>{{ $nota->autor }}:</strong></div><br>
                            <textarea readonly class="nota_entrada" rows="8" cols="40">{{ $nota->descricao }}</textarea> 
                        </div>
                        @endforeach
                    @else
                        <p>Sem notas disponíveis no momento.</p>
                    @endif
                </div>
                <!-- Links de Paginação -->
                <div class="conteiner_paginacao">
                    <!-- Botão Voltar -->
                    <a href="{{ $notas->previousPageUrl() }}" 
                       class="botao_paginacao @if ($notas->onFirstPage()) disabled @endif">
                        ← Recente
                    </a>
                    <p> &nbsp;|&nbsp; </p>
                    <!-- Botão Próximo -->
                    <a href="{{ $notas->nextPageUrl() }}" 
                       class="botao_paginacao @if (!$notas->hasMorePages()) disabled @endif">
                        Anterior →
                    </a>
                </div>

            </section>

            <form action="{{ route('adicaoNotaADM', $atendimento->codigo) }}" method="POST" id="meuFormulario">
                <section class="nota-item">
                @if($atendimento->fechamento == null) 
                    @csrf  <!-- CSRF Token para proteger o formulário -->
                            
                    <label for="resposta"><strong>Envie uma nova nota:</strong></label><br>
                    <textarea name="descricao" id="resposta" cols="25" rows="10" required></textarea>
                    <br><br>
                    <div>
                        <input type="submit" value="Enviar" id="botao_adiciona_nota">
                        <input type="reset" id="botao_limpar" value="Limpar">
                    </div>
                
                </section>
            </form>

            <!-- Seção de Fila e Escalonamento -->
            <section>

                @if($anexos->isNotEmpty())
                <h4>Anexos:</h4>
                <ul>
                    @foreach($anexos as $anexo)
                        <li>
                            <a href="{{ asset('storage/private/uploads' . $anexo->url_arquivo) }}" target="_blank">
                                {{ basename($anexo->url_arquivo) }}
                            </a>
                            <a href="{{ asset('storage/' . $anexo->url_arquivo) }}" target="_blank">Baixar Arquivo</a>
                        </li>

                    @endforeach
                </ul>
                @else
                    <p>Não há anexos para este atendimento.</p>
                @endif

                <br><br>
                <form action="{{ route('escalonamento', $atendimento->codigo) }}" method="POST">
                    @csrf
                    <label class="label" for="fila"><strong>Fila:</strong></label>
                    <select name="fila" id="fila" required>
                        <option value="1" {{ $atendimento->fila == '1' ? 'selected' : '' }}>Fila Nível 1</option>
                        <option value="2" {{ $atendimento->fila == '2' ? 'selected' : '' }}>Fila Nível 2</option>
                        <option value="3" {{ $atendimento->fila == '3' ? 'selected' : '' }}>Fila Nível 3</option>
                    </select>
                    <br>
                    <button type="submit" class="botao_paginacao">Escalonar</button>
                </form>
            

            <!-- Botão Assumir Atendimento -->
            
                <form action="{{ route('assumirAtendimento', $atendimento->codigo) }}" method="POST">
                    @csrf
                    <input type="hidden" name="encarregado" value="{{ session('login') }}">
                    <button type="submit" class="botao_paginacao" @if($atendimento->fechamento != null) disabled @endif>Assumir Atendimento</button>
                </form>

                <form action="{{ route('concluirAtendimento', $atendimento->codigo) }}" method="POST">
                    @csrf
                    <input type="hidden" name="situacao" value="fechado">
                    <button type="submit" class="botao_paginacao" @if($atendimento->fechamento != null) disabled @endif>Concluir Atendimento</button>
                </form>
            </section>

            @endif

        </div>
    </main>

    @include('administrador.rodape')

@endsection
