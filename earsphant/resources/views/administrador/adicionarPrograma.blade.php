@extends('base')

@section('titles', 'Adicionar novo ativo')

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
        
        <h1>Adicionar um Novo Programa</h1>
       
        <form id="form_active" action="{{ route('adicionarPrograma') }}" method="POST">
            @csrf
            <div id="formatacao_formulario_ativo">
                                
                    <label for="input_add_active_license">Licença:</label>
                    <input class="entrada_texto" id="input_add_active_license" name="licenca" type="text">
    
                    <label for="input_add_active_code">Numeração Interna:</label>
                    <input class="entrada_texto" id="input_add_active_code" name="codigo" type="text">
                    
                    <section  class="secao_formulario">
                        <label for="input_add_active_aquisition">Data de aquisição:</label>
                        <input class="entrada_data" id="input_add_active_aquisition" name="aquisicao" type="date">
    
                        <label for="dropdown_soft_or_hard">Desenvolvido por terceiros?</label>
                        <select class="estrada_lista_suspensa" id="dropdown_soft_or_hard" name="terceiros">
                            <option value="false">Não</option>
                            <option value="true">Sim</option>
                        </select>
                    </section>
    
                    <section  class="secao_formulario">
                        <label for="input_add_active_model">Nome:</label>
                        <input class="entrada_texto" id="input_add_active_model" name="nome"  type="text">
    
                        <label for="input_add_active_brand">Fornecedor:</label>
                        <input class="entrada_texto" id="input_add_active_brand" name="fornecedor" type="text">
                        
                        <label for="input_add_active_type">Versão:</label>
                        <input class="entrada_texto" id="input_add_active_type" name="versao" type="text">
                    </section>
                </div>

            <section id="grupo_botao">
                <input class="botao_adicao" type="submit" value="Adicionar">
                <input class="botao_cancelar" type="reset" value="Desistir">
            </section>

        </form>
        
    </main>

    @include('administrador.rodape')

@endsection