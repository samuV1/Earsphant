@extends('base')

@section('titles', 'Editar ativo')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/crud.css') }}>
@endsection

@section('pagina')

@include('administrador.cabecalho')
    
    <main class="elemento_pai">

        <h1>Editar Ativo</h1>
        
        <form id="formulario_editar_programa" action="{{ route('editarPrograma') }}" method="POST">
            @csrf
            <div id="formatacao_formulario_ativo">
                                
                    <label for="licenca">Licença:</label>
                    <input class="entrada_texto" id="licenca" name="licenca" type="text" value="{{ $programa->licenca }}">
    
                    <label for="codigo">Numeração Interna:</label>
                    <input class="entrada_texto" id="codigo" name="codigo" type="text" value="{{ $programa->codigo }}" readonly>
                    
                    <section  class="secao_formulario">
                        <label for="aquisicao">Data de aquisição:</label>
                        <input class="entrada_data" id="aquisicao" name="aquisicao" type="date" value="{{ $programa->aquisicao }}">
    
                        <label for="terceiros">Desenvolvido por terceiros?</label>
                        <select class="estrada_lista_suspensa" id="terceiros" name="terceiros">
                            <option value="false" {{ $programa->terceiros == 'false' ? 'selected' : ''}}>Não</option>
                            <option value="true" {{ $programa->terceiros == 'true' ? 'selected' : ''}}>Sim</option>
                        </select>
                    </section>
    
                    <section  class="secao_formulario">
                        <label for="nome">Nome:</label>
                        <input class="entrada_texto" id="nome" name="nome" type="text" value="{{ $programa->nome }}">
    
                        <label for="fornecedor">Fornecedor:</label>
                        <input class="entrada_texto" id="fornecedor" name="fornecedor" type="text" value="{{ $programa->fornecedor }}">
                        
                        <label for="versao">Versão:</label>
                        <input class="entrada_texto" id="versao" name="versao" type="text" value="{{ $programa->versao }}">
                    </section>
                </div>

            @if(session('acesso') == 2 or session('acesso') == 3)
            <section id="grupo_botao">
                <input class="botao_adicao" type="submit" value="Alterar">
                <input class="botao_cancelar" type="reset" value="Desistir">
                <input class="botao_remover" type="submit" value="Remover" formmethod="POST" formaction="{{ route('removerPrograma') }}">
            </section>
            @endif

        </form>
        
    </main>

    @include('administrador.rodape')

@endsection