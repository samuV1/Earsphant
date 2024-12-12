@section('cabecalho_css')
    <link rel="stylesheet" href={{ asset('css/modulo_usuario/cabecalho.css') }}>
@endsection

<header>
    
    <nav>
        <ul>
            <li><a class="nav" href="{{ route('inicioUsuario') }}">Ir para a página inicial</a></li>
            <li><a class="nav" href="{{ route('logout') }}">Sair do sistema</a></li>
        </ul>
        <ul>
            <a href="{{ route('inicioUsuario') }}"><img src="/imagens/logo_index.png" alt="Logo do sistema earsphant com um elefante com as orelhas abertas"></a>
        </ul>
    </nav>

</header>