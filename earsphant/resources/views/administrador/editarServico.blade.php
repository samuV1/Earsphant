@extends('base')

@section('titles', 'Editar serviço')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/crud.css') }}>
@endsection

@section('pagina')

@include('administrador.cabecalho')
    
    <main class="elemento_pai">
        
        <h1>Editar Serviço</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form id="formulario_editar_servico" action={{ route('editarServico') }} method="POST">
            @csrf

            <section>
                <section id="formatacao_formulario">
                    <section class="secao_formulario">
                        <label for="servico">Servico:</label>
                        <input class="entrada_texto" id="servico" name="servico" type="text" value="{{$servico->servico}}" readonly>
                    </section>

                    <section class="secao_formulario">
                        <label for="ans">Acordo a nível de serviço (em horas):</label>
                        <select class="entrada_texto" id="ans" name="ans">
                            <!-- Opção Default -->
                            <option value="00:00:00" {{ $servico->ans == '00:00:00' ? 'selected' : '' }}>Sem previsão</option>

                            <!-- Opções de 1 a 24 horas -->
                            <optgroup label="Horas">
                                <option value="01:00:00" {{ $servico->ans == '01:00:00' ? 'selected' : '' }}>1 hora</option>
                                <option value="02:00:00" {{ $servico->ans == '02:00:00' ? 'selected' : '' }}>2 horas</option>
                                <option value="03:00:00" {{ $servico->ans == '03:00:00' ? 'selected' : '' }}>3 horas</option>
                                <option value="04:00:00" {{ $servico->ans == '04:00:00' ? 'selected' : '' }}>4 horas</option>
                                <option value="05:00:00" {{ $servico->ans == '05:00:00' ? 'selected' : '' }}>5 horas</option>
                                <option value="06:00:00" {{ $servico->ans == '06:00:00' ? 'selected' : '' }}>6 horas</option>
                                <option value="07:00:00" {{ $servico->ans == '07:00:00' ? 'selected' : '' }}>7 horas</option>
                                <option value="08:00:00" {{ $servico->ans == '08:00:00' ? 'selected' : '' }}>8 horas</option>
                                <option value="09:00:00" {{ $servico->ans == '09:00:00' ? 'selected' : '' }}>9 horas</option>
                                <option value="10:00:00" {{ $servico->ans == '10:00:00' ? 'selected' : '' }}>10 horas</option>
                            </optgroup>

                            <!-- Opções de 1 a 3 dias -->
                            <optgroup label="Dias">
                                <option value="24:00:00" {{ $servico->ans == '24:00:00' ? 'selected' : '' }}>1 dia</option>
                                <option value="48:00:00" {{ $servico->ans == '48:00:00' ? 'selected' : '' }}>2 dias</option>
                                <option value="72:00:00" {{ $servico->ans == '72:00:00' ? 'selected' : '' }}>3 dias</option>
                            </optgroup>
                        </select>

                    </section>

                    <section class="secao_formulario">
                        <label for="status">Status</label>
                        <select class="estrada_lista_suspensa" id="status" name="status">
                            <option value="ativo" {{ $servico->status == 'ativo' ? 'selected' : ''}}>Serviço Ativo</option>
                            <option value="obsoleto" {{ $servico->status == 'obsoleto' ? 'selected' : ''}}>Serviço Obsoleto</option>
                        </select>
                    </section>
                </section>
            </section>
            @if(session('acesso') == 2 or session('acesso') == 3)  
            <section id="grupo_botao">
                <input class="botao_adicao" type="submit" value="Alterar">
                <input class="botao_cancelar" type="reset" value="Desistir">
                <input class="botao_remover" type="submit" value="Remover" formmethod="POST" formaction="{{ route('removerServico') }}">
            </section>            
            @endif
        </form>
        
    </main>

    @include('administrador.rodape')

@endsection