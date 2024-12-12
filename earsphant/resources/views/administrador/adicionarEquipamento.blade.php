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

        <h1>Adicionar um Novo Equipamento</h1>

        <form id="form_active" action="{{ route('adicionarEquipamento') }}" method="POST">
            @csrf
            <div id="formatacao_formulario_ativo">
                <label for="input_add_active_license">Código/Patrimônio:</label>
                <input class="entrada_texto" id="input_add_active_license" name="patrimonio" type="text" required>
        
                <label for="input_add_active_code">Tipo</label>
                <input class="entrada_texto" id="input_add_active_code" name="tipo" type="text" required>
        
                <section class="secao_formulario">
                    <label for="input_add_active_aquisition">Data de aquisição:</label>
                    <input class="entrada_data" id="input_add_active_aquisition" name="aquisicao" type="date" required>
        
                    <label for="dropdown_soft_or_hard">Equipamento alugado?</label>
                    <select class="estrada_lista_suspensa" id="dropdown_soft_or_hard" name="alugado" required>
                        <option value="false">Não</option>
                        <option value="true">Sim</option>
                    </select>
                </section>
        
                <section class="secao_formulario">
                    <label for="input_add_active_model">Marca:</label>
                    <input class="entrada_texto" id="input_add_active_model" name="marca" type="text">
        
                    <label for="input_add_active_type">Modelo:</label>
                    <input class="entrada_texto" id="input_add_active_type" name="modelo" type="text">
        
                    <label for="input_add_active_brand">Fornecedor:</label>
                    <input class="entrada_texto" id="input_add_active_brand" name="fornecedor" type="text">
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