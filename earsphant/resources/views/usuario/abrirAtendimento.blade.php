@extends('base')

@section('titles', 'Abrir uma solicitação')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_usuario/crud.css') }}>
@endsection


@section('pagina')

@include('usuario.cabecalho')

<main class="elemento_pai">
    <h1>Preencha os campos abaixo:</h1>

    <!-- Exibir mensagens de erro ou sucesso -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if (session('erro'))
        <div class="alert alert-danger">
            {{ session('erro') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário -->
    <form action="{{ route('armazenar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section>
            <label for="telefone">Informe o seu número de telefone para contato:</label>
            <input id="telefone" name="telefone" value="{{ old('telefone') }}">
        </section>

        <label for="descricao">Descreva abaixo o problema com máximo de detalhes:</label>          
        <textarea name="descricao" id="descricao" cols="100" rows="10">{{ old('descricao') }}</textarea>

        <section>
            <label for="servico">Escolha um assunto relacionado a sua solicitação:</label>
            <select name="servico" id="servico">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->servico }}" {{ old('servico') == $categoria->servico ? 'selected' : '' }}>
                        {{ $categoria->servico }}
                    </option>
                @endforeach
            </select>
        </section>

        <section>
            <label for="equipamento">Informe o número de identificação do equipamento relacionado a sua solicitação:</label>
            <input type="text" name="equipamento" value="{{ old('equipamento') }}">
        </section>

        <section>
            <label for="arquivo">Envie uma foto ou arquivo relacionado a sua demanda</label>
            <input type="file" name="arquivo">
        </section>

        <section>
            <br><br>
            <input type="submit" value="Abrir a Solicitação" id="botao_adicionar">
            <button id="botao_limpar"><a href="{{ route('inicioUsuario') }}" onclick="document.getElementById('meuFormulario').reset();">Desistir</a></button>
        </section>
    </form>

</main>

    @include('usuario.rodape')

@endsection