@extends('base')

@section('titles', 'Início')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_usuario/historico.css') }}>
@endsection


@section('pagina')

@include('administrador.cabecalho')
    
    <main class="elemento_pai">
        
        <h1>Fila do Setor</h1>

        <div class="areaTicket">
            @if($atendimentos->isEmpty())
            <p class="historico">Você não possui atendimentos em aberto.</p>
            @else
                <ul class="historico">
                    @foreach ($atendimentos as $atendimento)
                        <li class="historico">
                            <strong class="historico">Código:</strong> {{ $atendimento->codigo }} 
                            <strong class="historico">| Serviço:</strong> {{ $atendimento->servico }}
                            <strong class="historico">| Prioridade:</strong> {{ $atendimento->prioridade }}  <br>
                            <strong class="historico">Data de Fechamento:</strong> {{ $atendimento->fechamento }} <br>
                            <a class="historico" href="{{ route('atendimentoADM', $atendimento->codigo) }}">Ver detalhes</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        
    </main>

    @include('administrador.rodape')

@endsection