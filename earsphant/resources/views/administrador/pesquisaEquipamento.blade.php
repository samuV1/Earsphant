@extends('base')

@section('titles', 'Pesquisar ativo')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/pesquisa.css') }}>
@endsection


@section('pagina')

@include('administrador.cabecalho')
    
    <main class="elemento_pai">
        
        <h1>Pesquisar Equipamento</h1>

        <form id="formulario_pesquisar_equipamentos" action="{{ route('pesquisaEquipamento') }}" method="get">
            @csrf
        <section class="inputPesquisa">
            <label for="patrimonio">Código/Patrimônio:</label>
            <input class="entrada_texto" id="patrimonio" name="patrimonio" type="text" value="{{request('patrimonio')}}">
        
            <label for="tipo">Tipo</label>
            <input class="entrada_texto" id="tipo" name="tipo" type="text" value="{{request('tipo')}}">

            <label for="aquisicao">Data de aquisição:</label>
            <input class="entrada_data" id="aquisicao" name="aquisicao" type="date" value="{{request('aquisicao')}}">
        </section>
        <section class="inputPesquisa">
            <label for="alugado">Equipamento alugado?</label>
            <select class="estrada_lista_suspensa" id="alugado" name="alugado">
                <option value="" {{ request('alugado') == '' ? 'selected' : '' }}>Selecione</option>
                <option value="false" {{ request('alugado') == 'false' ? 'selected' : '' }}>Não</option>
                <option value="true" {{ request('alugado') == 'true' ? 'selected' : '' }}>Sim</option>
            </select>
 
            <label for="marca">Marca:</label>
            <input class="entrada_texto" id="marca" name="marca" type="text" value="{{request('marca')}}">
        
            <label for="modelo">Modelo:</label>
            <input class="entrada_texto" id="modelo" name="modelo" type="text" value="{{request('modelo')}}">
           </section>
            <section class="grupoBotao">
                <input class="botao_pesquisar" type="submit" value="Pesquisar">
                <input class="botao_limpar" type="reset" value="Desistir">
            </section>
        </form>

        <section>
            <div class="areaTicket">
                @foreach ($equipamentos as $equipamento)
                    <li class="pesquisa">
                        <strong class="pesquisa">Nome:</strong> {{ $equipamento->tipo }} 
                        <strong class="pesquisa">| Setor:</strong> {{ $equipamento->modelo }} 
                        <strong class="pesquisa">| Login:</strong> {{ $equipamento->patrimonio }} 
                        <a class="pesquisa" href="{{route('exibirEditarEquipamento',[ $equipamento ])}}">Ver detalhes</a>
                    </li>
                @endforeach
            </div>
        </section>
        
    </main>

    @include('administrador.rodape')

@endsection