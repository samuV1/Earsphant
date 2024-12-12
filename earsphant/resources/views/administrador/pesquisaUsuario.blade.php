@extends('base')

@section('titles', 'Pesquisar usuário')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/pesquisa.css') }}>
@endsection


@section('pagina')

    @include('administrador.cabecalho')
    
    <main class="elemento_pai">

        <h1>Pesquisar Usuário</h1>

        <form id="formulario_pesquisar_usuario" action="{{ route('pesquisaUsuario') }}" method="POST" >
            @csrf
            <section id="formatacao_formulario_pesquisar_usuario">

                <div id="div_detalhes">
                    
                    <section class="formatacao_seções_formulario">
                        <label for="nome">Nome:</label>
                        <input class="entrada_texto" id="nome" name="nome" type="text" value="{{ request('nome') }}">

                        <label for="setor">Setor:</label>
                        <input class="entrada_texto" id="setor" name="setor" type="text" value="{{ request('setor') }}">

                        <label for="acesso">Acesso:</label>
                        <select class="estrada_lista_suspensa" id="acesso" name="acesso">
                            <option value="" {{ request('acesso') === null ? 'selected' : '' }}>Todos</option>
                            <option value="0" {{ request('acesso') == '0' ? 'selected' : '' }}>Usuário</option>
                            <option value="1" {{ request('acesso') == '1' ? 'selected' : '' }}>Técnico (nível 1)</option>
                            <option value="2" {{ request('acesso') == '2' ? 'selected' : '' }}>Analista (nível 2)</option>
                            <option value="3" {{ request('acesso') == '3' ? 'selected' : '' }}>Administrador</option>
                        </select>

                        <label for="login">Usuário:</label>
                        <input class="entrada_texto" id="login" name="login" type="text" value="{{ request('login') }}">              
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
                    @foreach ($usuarios as $usuario)
                        <li class="pesquisa">
                            <strong class="pesquisa">Nome:</strong> {{ $usuario->nome }} 
                            <strong class="pesquisa">| Setor:</strong> {{ $usuario->setor }} 
                            <strong class="pesquisa">| Login:</strong> {{ $usuario->login }} 
                            <a class="pesquisa" href="{{ route('exibirEditarUsuario', [$usuario]) }}">Ver detalhes</a>
                        </li>
                    @endforeach
                </div>
            </section>
    </main>

    @include('administrador.rodape')

@endsection