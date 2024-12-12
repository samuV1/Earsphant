@extends('base')

@section('titles', 'Pesquisar ticket')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/pesquisa.css') }}>
@endsection


@section('pagina')

@include('administrador.cabecalho')
    
    <main class="elemento_pai">

        <h1>Pesquisar Serviço</h1>

        <form id="formulario_pesquisa_servico" action="{{ route('pesquisaServico') }}" method="POST" >
            @csrf
            <section id="formatacao_formulario_pesquisa_servico">

                <div id="div_detalhes">
                    <label for="servico">Nome:</label>
                        <input class="entrada_texto" id="servico" name="servico" type="text" value="{{request('servico')}}">

                        <label for="ans">Acordo a nível de serviço:</label>
                        <select class="entrada_texto" id="ans" name="ans">
                            <!-- Opção Default -->
                            <option value="00:00:00" {{ request('ans') == '00:00:00' ? 'selected' : '' }}>Sem previsão</option>
                            
                            <!-- Opções de 1 a 24 horas -->
                            <optgroup label="Horas">
                                <option value="01:00:00" {{ request('ans') == '01:00:00' ? 'selected' : '' }}>1 hora</option>
                                <option value="02:00:00" {{ request('ans') == '02:00:00' ? 'selected' : '' }}>2 horas</option>
                                <option value="03:00:00" {{ request('ans') == '03:00:00' ? 'selected' : '' }}>3 horas</option>
                                <option value="04:00:00" {{ request('ans') == '04:00:00' ? 'selected' : '' }}>4 horas</option>
                                <option value="05:00:00" {{ request('ans') == '05:00:00' ? 'selected' : '' }}>5 horas</option>
                                <option value="06:00:00" {{ request('ans') == '06:00:00' ? 'selected' : '' }}>6 horas</option>
                                <option value="07:00:00" {{ request('ans') == '07:00:00' ? 'selected' : '' }}>7 horas</option>
                                <option value="08:00:00" {{ request('ans') == '08:00:00' ? 'selected' : '' }}>8 horas</option>
                                <option value="09:00:00" {{ request('ans') == '09:00:00' ? 'selected' : '' }}>9 horas</option>
                                <option value="10:00:00" {{ request('ans') == '10:00:00' ? 'selected' : '' }}>10 horas</option>
                            </optgroup>
                        
                            <!-- Opções de 1 a 3 dias -->
                            <optgroup label="Dias">
                                <option value="24:00:00" {{ request('ans') == '24:00:00' ? 'selected' : '' }}>1 dia</option>
                                <option value="48:00:00" {{ request('ans') == '48:00:00' ? 'selected' : '' }}>2 dias</option>
                                <option value="72:00:00" {{ request('ans') == '72:00:00' ? 'selected' : '' }}>3 dias</option>
                            </optgroup>
                        </select>
                        
                        <label for="status">Status:</label>
                        <select class="entrada_texto" id="status" name="status">
                            <option value="" {{ request('status') == '' ? 'selected' : '' }}>Selecione</option>
                            <optgroup label="Status">
                                <option value="ativo" {{ request('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="obsoleto" {{ request('status') == 'obsoleto' ? 'selected' : '' }}>Obsoleto</option>
                            </optgroup>
                        </select>
                        
                </div>
            </section>

            <section class="grupoBotao">
                <input class="botao_pesquisar" type="submit" value="Pesquisar">
                <input class="botao_limpar" type="reset" value="Limpar">
            </section>
        </form>
            <section>
                <div class="areaTicket">
                    @foreach ($servicos as $servico)
                        <li class="pesquisa">
                            <strong class="pesquisa">Servico:</strong> {{ $servico->servico }} 
                            <strong class="pesquisa">| Status:</strong> {{ $servico->status }} 
                            <strong class="pesquisa">| Acordo a nível de servico:</strong> {{ $servico->ans ?? 'Não se aplica' }}
                            @if (session('acesso') == 3)
                                <a class="pesquisa" href="{{ route('exibirEditarServico', [$servico]) }}">Ver detalhes</a>
                            @endif
                        </li>
                    @endforeach
                </div>
            </section>

    </main>

    @include('administrador.rodape')

@endsection