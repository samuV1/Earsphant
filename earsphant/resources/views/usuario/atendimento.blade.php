@extends('base')

@section('titles', 'Detalhes')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_usuario/atendimento.css') }}>
@endsection


@section('pagina')

    @include('usuario.cabecalho')
    
    <main class="elemento_pai">
    
        <h1>Detalhes do Atendimento</h1>

        <div>
            <section>
        
                <label class="etiqueta" for="codigo"><strong>Código:</strong></label>
                <input type="text" id="codigo" name="codigo" value="{{ $atendimento->codigo }}" readonly>

                <label class="etiqueta" for="servico"><strong>Serviço:</strong></label>
                <input type="text" id="servico" name="servico" value="{{ $atendimento->servico}}" readonly>

                <label class="etiqueta" for="status"><strong>Status:</strong></label>
                <input type="text" id="status" name="status" value="{{ $atendimento->status }}" readonly>

                <label class="etiqueta" for="abertura"><strong>Data de Abertura:</strong></label>
                <input type="text" id="abertura" name="abertura" value="{{ $atendimento->abertura }}" readonly>
            
                <label class="etiqueta" for="fechamento"><strong>Data de Fechamento:</strong></label>
                <input type="text" id="fechamento" name="fechamento" value="{{ $atendimento->fechamento ?? 'Não finalizado' }}" readonly>
        
            </section>
            <section>

                <label class="etiqueta" for="descricao"><strong>Descrição:</strong></label>
                <textarea id="descricao" name="descricao" rows="7" cols="50" readonly>{{ $atendimento->descricao }}</textarea><br>

                <label class="etiqueta" for="notas"><strong>Notas:</strong></label>
                <div class="conteiner_notas">
                    @if(count($notas) > 0)
                        @foreach($notas as $nota)
                        <div class="nota-item">
                            <div><strong>{{ $nota->autor }}:</strong></div><br>
                            <textarea readonly class="nota_entrada" rows="8" cols="50">{{ $nota->descricao }}</textarea> 
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

            <form action="{{ route('adicaoNotaUsuario', $atendimento->codigo) }}" method="POST" id="meuFormulario">
            <section class="nota-item">
            @if($atendimento->fechamento == null) 
                @csrf  <!-- CSRF Token para proteger o formulário -->
                        
                <label for="resposta"><strong>Envie uma nova nota:</strong></label><br>
                <textarea name="descricao" id="resposta" cols="30" rows="10" required></textarea>
                <br><br>
                <div>
                    <input type="submit" value="Enviar" id="botao_adiciona_nota">
                    <button id="botao_limpar"><a href="{{ route('inicioUsuario') }}" onclick="document.getElementById('meuFormulario').reset();">Desistir</a></button>
                </div>   
                
            @endif
            </section>
        </form>

        </div>
    </main>

    @include('usuario.rodape')

@endsection