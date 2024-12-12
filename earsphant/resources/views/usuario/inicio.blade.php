@extends('base')

@section('titles', 'Início')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_usuario/home.css') }}>
@endsection


@section('pagina')

    @include('usuario.cabecalho')
    
    <main class="elemento_pai">
        

        <h1>O que você deseja fazer?</h1>

        <section id="escolha_usuario">
            <a class="escolha_usuario" href="{{ route('abrirAtendimentos') }}">Abrir uma solicitação de atendimento</a>

            <a class="escolha_usuario" href="{{ route('atendimentoHistoricoAberto') }}">Acompanhar um atendimento em aberto</a>

            <a class="escolha_usuario" href="{{ route('tickets.historico') }}">Ver o seu histórico de solicitações</a>
        </section>
    </main>

    @include('usuario.rodape')

@endsection