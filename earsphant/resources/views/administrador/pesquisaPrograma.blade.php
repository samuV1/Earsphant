@extends('base')

@section('titles', 'Pesquisar ativo')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/pesquisa.css') }}>
@endsection


@section('pagina')

@include('administrador.cabecalho')
    
    <main class="elemento_pai">
        
        <h1>Pesquisar Programa</h1>

        
        <form id="formulario_pesquisar_programa" action="{{ route('pesquisaProgramas') }}" method="POST">
            @csrf

            <section class="inputPesquisa">              
            <label for="licenca">Licença:</label>
            <input class="entrada_texto" id="licenca" name="licenca" type="text" value="{{request('licenca')}}">
    
            <label for="codigo">Numeração Interna:</label>
            <input class="entrada_texto" id="codigo" name="codigo" type="text" value="{{request('codigo')}}">
                    
            <label for="aquisicao">Data de aquisição:</label>
            <input class="entrada_data" id="aquisicao" name="aquisicao" type="date" value="{{request('aquisicao')}}">
            </section>    

            <section class="inputPesquisa">
                <label for="terceiros">Desenvolvido por terceiros?</label>
                <select class="estrada_lista_suspensa" id="terceiros" name="terceiros">
                    <option value="" {{ request('terceiros') == '' ? 'selected' : '' }}>Selecione</option>
                    <option value="false" {{ request('terceiros') == 'false' ? 'selected' : '' }}>Não</option>
                    <option value="true" {{ request('terceiros') == 'true' ? 'selected' : '' }}>Sim</option>
                </select>
    
            <label for="nome">Nome:</label>
            <input class="entrada_texto" id="nome" name="nome"  type="text" value="{{request('nome')}}">
    
            <label for="fornecedor">Fornecedor:</label>
            <input class="entrada_texto" id="fornecedor" name="fornecedor" type="text" value="{{request('fornecedor')}}">
            </section>           

            <section class="grupoBotao">
                <input class="botao_pesquisar" type="submit" value="Pesquisar">
                <input class="botao_limpar" type="reset" value="Limpar">
            </section>

        </form>

        <section>
            <div class="areaTicket">
                @foreach ($programas as $programa)
                    <li class="pesquisa">
                        <strong class="pesquisa">Nome:</strong> {{ $programa->nome }} 
                        <strong class="pesquisa">| Código:</strong> {{ $programa->codigo }} 
                        <strong class="pesquisa">| Tipo:</strong> {{ $programa->tipo }} 
                        <a class="pesquisa" href="{{ route('exibirEditarPrograma',[ $programa ]) }}">Ver detalhes</a>
                    </li>
                @endforeach
            </div>
        </section>
    </main>

    @include('administrador.rodape')

@endsection