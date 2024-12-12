@extends('base')

@section('titles', 'Abrir uma solicitação')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_usuario/crud.css') }}>
@endsection


@section('pagina')

@include('administrador.cabecalho')

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
    <form action="{{ route('abrirAtendimentoADM') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section>
            <label for="">Telefone:</label>
            <input type="tel" name="telefone" value="{{ old('telefone') }}">

            <label for="">Login:</label>
            <input type="text" name="login" value="{{ old('login') }}">

            <label for="">Setor:</label>
            <input type="text" name="setor" value="{{ old('setor') }}">
        </section>

            <label for="">Descrição:</label>          
            <textarea name="descricao" id="" cols="75" rows="8">{{ old('descricao') }}</textarea>

        <section>
            <label for="">Escolha um assunto relacionado a sua solicitação:</label>
            <select name="servico" id="">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->servico }}" {{ old('servico') == $categoria->servico ? 'selected' : '' }}>
                        {{ $categoria->servico }}
                    </option>
                @endforeach
            </select>

            <label for="">Subserviço:</label>
            <input type="text" name="subservico" value="{{ old('subservico') }}">
        </section>

        <section>
            <label for="">Equipamento relacionado:</label>
            <input type="text" name="equipamento_id" value="{{ old('equipamento_id') }}">

            <label for="">Arquivo</label>
            <input type="file" name="arquivo">
        </section>


        <section>
            <br><br>
            <input type="submit" value="Abrir a Solicitação" id="botao_adicionar">
            <button id="botao_limpar"><a href="{{ route('inicioUsuario') }}" onclick="document.getElementById('meuFormulario').reset();">Desistir</a></button>
        </section>
    </form>

</main>


    @include('administrador.rodape')

@endsection