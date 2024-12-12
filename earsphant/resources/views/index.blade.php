@extends('base')

@section('titles', 'Acesso ao sistema')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/login.css') }}>
@endsection


@section('pagina')
    
    <main class="elemento_pai">
        <a href="{{ route('index') }}"><img src="imagens/logo_index.png" alt="Logo do sistema earsphant com um elefante com as orelhas abertas"></a>


        <!--Formulário de login-->

        <form class="elemento_pai" action={{ route( 'index' ) }} method="POST">

            <h2>Preencha os campos abaixo:</h2>

            <br>
            @csrf
            <label class="etiqueta_login" for="login">Usuário:</label>
            <input id="login" name="login" type="text" value="{{ old('login') }}" required>
            {{ $errors->has('login') ? $errors->first('login') : '' }}
            <br>

            <label class="etiqueta_login" for="senha">Senha:</label>
            <input id="senha" name="senha" type="password" value="{{ old('senha') }}" required>
            {{ $errors->has('senha') ? $errors->first('senha') : '' }}

            <input id="botao_unico_acesso" type="submit" value="Acessar">

        </form>
        @if ($errors->any())
            <div>
                <strong>{{ $errors->first('error') }}</strong>
            </div>
        @endif
        
    </main>

@endsection