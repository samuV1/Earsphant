@extends('base')

@section('titles', 'Estatísticas')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/crud.css') }}>
@endsection

@section('pagina')

@include('administrador.cabecalho')
    
    <main class="elemento_pai">

        <h1>Estatísticas</h1>

   
        
    </main>

    @include('administrador.rodape')

@endsection