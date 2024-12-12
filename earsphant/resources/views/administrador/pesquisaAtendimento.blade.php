@extends('base')

@section('titles', 'Pesquisar ticket')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/pesquisa.css') }}>
@endsection


@section('pagina')

@include('administrador.cabecalho')
    
    <main class="elemento_pai">

        <h1>Pesquisar Atendimentos</h1>

        <form id="formulario_pesquisar_atendimentos" action="{{ route('pesquisaAtendimento') }}" method="POST" >
            @csrf
            <section id="formatacao_formulario_pesquisar_atendimentos">

                <div id="div_detalhes">
                    
                    <section class="formatacao_seções_formulario">
                        <label for="codigo">Código:</label>
                        <input class="entrada_texto" id="codigo" name="codigo" type="text" value="{{request('codigo')}}">

                        <label for="setor">Setor:</label>
                        <input class="entrada_texto" id="setor" name="setor" type="text" value="{{request('setor')}}">

                        <label for="usuario">Login do Usuário:</label>
                        <input class="entrada_texto" id="usuario" name="usuario" type="text" value="{{request('usuario')}}">

                        <label for="status">Status:</label>
                        <select class="estrada_lista_suspensa" id="status" name="status">
                            <option value="" {{ request('status') == '' ? 'selected' : '' }}>Todos</option>
                            <option value="Aberto" {{ request('status') == 'aberto' ? 'selected' : '' }}>Aberto</option>
                            <option value="Finalizado" {{ request('status') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                            <option value="Em atendimento" {{ request('status') == '2' ? 'selected' : '' }}>Em atendimento</option>
                        </select>

                        <label for="servico">Serviço:</label>
                        <select name="servico" id="servico">
                            <option value="" {{ request('servico') == '' ? 'selected' : '' }}>Todos</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->servico }}" 
                                    {{ request('servico') == $categoria->servico ? 'selected' : '' }}>
                                    {{ $categoria->servico }}
                                </option>
                            @endforeach
                        </select>

 
                    </section>
                    <br>
                    <section>
                        <label for="descricao">Descrição:</label>
                        <input class="entrada_texto" id="descricao" name="descricao" type="text" value="{{request('descricao')}}">

                        <label for="programa">Programa:</label>
                        <select name="programa" id="programa">
                            <option value="" {{ request('programa') == '' ? 'selected' : '' }}>Todos</option>
                        @foreach ($programas as $programa)
                                <option value="{{ $programa->codigo }}" 
                                    {{ request('programa') == $programa->codigo ? 'selected' : '' }}>
                                    {{ $programa->nome }}
                                </option>
                        @endforeach
                    </select>
                        <label for="equipamento">Equipamento:</label>
                        <select name="equipamento" id="equipamento">
                            <option value="" {{ request('equipamento') == '' ? 'selected' : '' }}>Todos</option>
                        @foreach ($equipamentos as $equipamento)
                                <option value="{{ $equipamento->patrimonio }}" 
                                    {{ request('equipamento') == $equipamento->patrimonio ? 'selected' : '' }}>
                                    {{ $equipamento->patrimonio }}
                                </option>
                        @endforeach
                    </select>
                    </section>
                </div>
            </section>

            <section class="grupoBotao">
                <input class="botao_pesquisar" type="submit" value="Pesquisar">
                <input class="botao_limpar" type="reset" value="Limpar">
            </section>
        </form>
            <section>
                <div class="areaTicket">
                    @foreach ($atendimentos as $atendimento)
                        <li class="pesquisa">
                            <strong class="pesquisa">Código:</strong> {{ $atendimento->codigo }} 
                            <strong class="pesquisa">| Servico:</strong> {{ $atendimento->servico }} 
                            <strong class="pesquisa">| Usuario:</strong> {{ $atendimento->usuario }} 
                            <a class="pesquisa" href="{{ route('atendimentoADM', $atendimento->codigo) }}">Ver detalhes</a>
                        </li>
                    @endforeach
                </div>
            </section>

    </main>

    @include('administrador.rodape')

@endsection