@extends('base')

@section('titles', 'Abertos')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_usuario/historico.css') }}>
@endsection


@section('pagina')

    @include('usuario.cabecalho')

    
    <main class="elemento_pai">
        

        <h1>Abertos</h1>

        <div class="areaTicket">
            @if($atendimentos->isEmpty())
            <p class="atendimentoAberto">Você não possui atendimentos finalizados.</p>
            @else
                <ul class="atendimentoAberto">
                    @foreach ($atendimentos as $atendimento)
                        <li class="atendimentoAberto">
                            <strong class="atendimentoAberto">Código:</strong> {{ $atendimento->codigo }} 
                            <strong class="atendimentoAberto">| Serviço:</strong> {{ $atendimento->servico }} 
                            <strong class="atendimentoAberto">| Situação:</strong> {{ $atendimento->status }} 
                            <strong class="atendimentoAberto">| Data de abertura:</strong> {{ \Carbon\Carbon::parse($atendimento->abertura)->format('d/m/Y H:i') }} <br>
                            <a class="atendimentoAberto" href="{{ route('atendimento', $atendimento->codigo) }}">Ver detalhes</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        
    </main>

    @include('usuario.rodape')

@endsection