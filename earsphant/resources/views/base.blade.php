<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('titles')</title>
        <link rel="icon" type="image/x-icon" href="/imagens/favicon.ico">
        <link rel="stylesheet" href={{ asset('css/estilo.css') }}>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        @yield('estilo_pagina_css')
        @yield('cabecalho_css')
    </head>
    <body>
        @yield('pagina')
    </body>
</html>