@extends('base')

@section('titles', 'Adicionar novo usuário')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/crud.css') }}>
@endsection


@section('pagina')

@include('administrador.cabecalho')
    
    <main class="elemento_pai">
        
         <!-- Exibir mensagem de sucesso se existir -->
         @if(session('success'))
         <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h1>Adicionar um Novo Usuário</h1>

        <form id="formulario_usuario" action="{{ route('adicionarUsuario') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <section id="format_formulario_usuario">

                <div id="div_detalhes">
                    
                    <section class="formatacao_seções_formulario">
                        <label for="usuario_nome">Nome:</label>
                        <input class="entrada_texto" id="usuario_nome" name="nome" type="text">
                    </section>
                    <section class="formatacao_seções_formulario">
                        <label for="usuario_setor">Setor:</label>
                        <input class="entrada_texto" id="usuario_setor" name="setor" type="text">
                        <label for="dropdown_level_access">Acesso:</label>
                        <select class="estrada_lista_suspensa" id="dropdown_level_access" name="acesso">
                        <option value="0">Usuário</option>
                        <option value="1">Técnico (nível 1)</option>
                        <option value="2">Analista (nível 2)</option>
                        <option value="3">Administrador</option>
                    </select>
                    </section>
                    <section class="formatacao_seções_formulario">
                        <label for="usuario_login">Usuário:</label>
                        <input class="entrada_texto" id="usuario_login" name="login" type="text">
                    
                        <label for="usuario_senha">Senha:</label>
                        <input class="entrada_texto" id="usuario_senha" name="senha" type="text">                
                    </section>
                </div>

                <div id="div_picture_profile"> 
                    <h3>Foto do Perfil:</h3>

                    <img id="preview" src="/imagens/user.jpg" alt="Preview da Imagem">

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


            <section id="grupo_botao">
                <input class="botao_adicao" type="submit" value="Adicionar">
                <input class="botao_cancelar" type="reset" value="Desistir">
            </section>


        </form>
        
    </main>

    @include('administrador.rodape')

@endsection