@extends('base')

@section('titles', 'Pesquisar ticket')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/pesquisa.css') }}>
@endsection


@section('pagina')

@include('administrador.cabecalho')
    
    <main class="elemento_pai"> 

        <h1>Pesquisar Setor</h1>

        <form id="formulario_pesquisar_setor" action="{{ route('pesquisaSetor') }}" method="POST" >
            @csrf
            <section id="formatacao_formulario_pesquisar_setor">

                <div id="div_detalhes">
                    
                    <label for="codigo">Código:</label>
                    <input class="entrada_texto" id="codigo" name="codigo" type="number" value="{{ request('codigo') }}">

                    <label for="nome">Nome:</label>
                    <input class="entrada_texto" id="nome" name="nome" type="text" value="{{ request('nome') }}">
      
                </div>
            </section>

            <section class="grupoBotao">
                <input class="botao_pesquisar" type="submit" value="Pesquisar">
                <input class="botao_limpar" type="reset" value="Limpar">
            </section>
        </form>
            <section>
                <div class="areaTicket">
                    @foreach ($setores as $setor)
                        <li class="pesquisa">
                            <strong class="pesquisa">Código:</strong> {{ $setor->codigo }} 
                            <strong class="pesquisa">| Setor:</strong> {{ $setor->nome }}  
                            @if (session('acesso') == 3)
                                <a class="pesquisa" href="{{ route('exibirEditarSetor', [$setor]) }}">Ver detalhes</a>
                            @endif                        
                        </li>
                    @endforeach
                </div>
            </section>

    </main>

    @include('administrador.rodape')

@endsection