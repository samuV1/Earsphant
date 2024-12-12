@extends('base')

@section('titles', 'Editar ativo')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/crud.css') }}>
@endsection

@section('pagina')

@include('administrador.cabecalho')
    
    <main class="elemento_pai">

        <h1>Editar Equipamento</h1>

        <form id="formulario_editar_equipamento" action="{{ route('atualizarEquipamento') }}" method="POST">
            @csrf
            <div id="formatacao_formulario_ativo">
                <label for="patrimonio">Código/Patrimônio:</label>
                <input class="entrada_texto" id="patrimonio" name="patrimonio" type="text" value="{{$equipamento->patrimonio}}" readonly>
        
                <label for="tipo">Tipo:</label>
                <input class="entrada_texto" id="tipo" name="tipo" type="text" value="{{$equipamento->tipo}}">
        
                <section class="secao_formulario">
                    <label for="aquisicao">Data de aquisição:</label>
                    <input class="entrada_data" id="aquisicao" name="aquisicao" type="date" value="{{$equipamento->aquisicao}}">
        
                    <label for="alugado">Equipamento alugado?</label>
                    <select class="estrada_lista_suspensa" id="alugado" name="alugado" >
                        <option value="false" {{ $equipamento->alugado == 'false' ? 'selected' : ''}}>Não</option>
                        <option value="true" {{ $equipamento->alugado == 'true' ? 'selected' : ''}}>Sim</option>
                    </select>
                </section>
        
                <section class="secao_formulario">
                    <label for="marca">Marca:</label>
                    <input class="entrada_texto" id="marca" name="marca" type="text" value="{{$equipamento->marca}}">
        
                    <label for="modelo">Modelo:</label>
                    <input class="entrada_texto" id="modelo" name="modelo" type="text" value="{{$equipamento->modelo}}">
        
                    <label for="fornecedor">Fornecedor:</label>
                    <input class="entrada_texto" id="fornecedor" name="fornecedor" type="text" value="{{$equipamento->fornecedor}}">
                </section>
            </div>
        @if(session('acesso') == 2 or session('acesso') == 3)
            <section id="grupo_botao">
                <input class="botao_adicao" type="submit" value="Alterar">
                <input class="botao_cancelar" type="reset" value="Desistir">
                <input class="botao_remover" type="submit" value="Remover" formmethod="POST" formaction="{{ route('removerEquipamento') }}">
            </section>
        @endif
        </form>
        
    </main>

    @include('administrador.rodape')

@endsection