@extends('base')

@section('titles', 'Editar usuário')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/crud.css') }}>
@endsection


@section('pagina')

@include('administrador.cabecalho')
    
    <main class="elemento_pai">
        
        <h1>Editar Usuário</h1>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form id="formulario_usuario" action="{{ route('editarUsuario') }}" method="POST">
        @csrf

        <section id="format_formulario_usuario">

            <div id="div_detalhes">
                
                <section class="formatacao_seções_formulario">
                    <label for="usuario_nome">Nome:</label>
                    <input class="entrada_texto" id="usuario_nome" name="nome" type="text" value="{{ $usuario->nome }}">
                </section>
                <section class="formatacao_seções_formulario">
                    <label for="usuario_setor">Setor:</label>
                    <input class="entrada_texto" id="usuario_setor" name="setor" type="text" value="{{ $usuario->setor }}">
                    <label for="acesso">Acesso:</label>
                    <select class="estrada_lista_suspensa" id="acesso" name="acesso">
                        <option value="0" {{ $usuario->acesso == '0' ? 'selected' : '' }}>Usuário</option>
                        <option value="1" {{ $usuario->acesso == '1' ? 'selected' : '' }}>Técnico - Nível 1</option>
                        <option value="2" {{ $usuario->acesso == '2' ? 'selected' : '' }}>Analista - Nível 2</option>
                        <option value="3" {{ $usuario->acesso == '3' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </section>
                <section class="formatacao_seções_formulario">
                    <label for="usuario_login">Usuário:</label>
                    <input class="entrada_texto" id="usuario_login" name="login" type="text" value="{{$usuario->login}}" readonly>
                
                    <label for="usuario_senha">Senha:</label>
                    <input class="entrada_texto" id="usuario_senha" name="senha" type="password" value="{{$usuario->senha}}">

                </section>
            </div>

            <div id="div_picture_profile"> 
                <h3>Foto do Perfil:</h3>

                <img id="preview" src="{{ $usuario->url_foto ? asset('storage/' . $usuario->url_foto) : '/imagens/user.jpg' }}" alt="Preview da Imagem">

                <label id="bunton_choice_picture" for="fileInput">Escolher Imagem</label>
                <input type="file" id="fileInput" class="inputpicture" accept="image/*" name="url_foto">
                    
                <script>
                    const fileInput = document.getElementById('fileInput');
                    const preview = document.getElementById('preview');

                    fileInput.addEventListener('change', function() {
                        const file = this.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(event) {                                        preview.src = event.target.result;
                            }
                            reader.readAsDataURL(file);
                        } else {
                            preview.src = '#';
                        }
                    });
                </script>               
            </div>
        </section>
        @if(session('acesso') == 2 or session('acesso') == 3)
        <section id="grupo_botao">
            <input class="botao_adicao" type="submit" value="Salvar Alterações">
            <input class="botao_cancelar" type="reset" value="Desistir">
            <input class="botao_remover" type="submit" value="Remover" formmethod="POST" formaction="{{ route('removerUsuario') }}">
        </section>
        @endif
    </form>
        
    </main>

    @include('administrador.rodape')

@endsection