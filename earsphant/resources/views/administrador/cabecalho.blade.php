@section('cabecalho_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/cabecalho.css') }}>
@endsection

<header>
    <nav>
        <ul>
        <li>
            <a class="nav" href="{{ route('inicioAdm') }}">Início</a></li>
            <li>
                <div class="dropdown">
                    <a onclick="toggleDropdown('myDropdown')" class="dropbtn">Solicitações</a>
                    <div id="myDropdown" class="dropdown-content">
                      <a href="{{route('abrirAtendimentoADM')}}">Abrir Solicitação</a>
                      <a href="{{route('minhaFila')}}">Minha Fila</a>
                      <a href="{{route('filaSetor')}}">Fila do Setor</a>
                      <a href="{{ route('filaAtendimentoAbertos') }}">Ver Solicitações Abertas</a>
                    </div>
                </div>  
            </li>
            <li>
                <div class="dropdown3">
                    <a onclick="toggleDropdown('myDropdown3')" class="dropbtn3">Pesquisar</a>
                    <div id="myDropdown3" class="dropdown-content3">
                        <a href="{{ route('pesquisaAtendimento') }}">Solicitações</a>
                        <a href="{{ route('pesquisaUsuario') }}">Usuários</a>
                        <a href="{{ route('pesquisaProgramas') }}">Programas</a>
                        <a href="{{ route('pesquisaEquipamento') }}">Equipamentos</a>
                        <a href="{{ route('pesquisaServico') }}">Serviço</a>
                        <a href="{{ route('pesquisaSetor') }}">Setor</a>
                    </div>
                </div> 
               
            @if(session('acesso') == 3 or session('acesso') == 2)
            </li>          
                <div class="dropdown2">
                    <a onclick="toggleDropdown('myDropdown2')" class="dropbtn2">Cadastrar</a>
                    <div id="myDropdown2" class="dropdown-content2">
                      
                      <a href="{{ route('adicionarPrograma') }}">Programa</a>
                      <a href="{{ route('adicionarEquipamento') }}">Equipamento</a>
                      @if(session('acesso') == 3)
                        <a href="{{ route('adicionarUsuario') }}">Usuário</a>
                        <a href="{{ route('adicionarSetor') }}">Setor</a>
                        <a href="{{ route('adicionarServico') }}">Serviço</a>
                      @endif
                    </div>
                </div>
            </li>
            @endif
            <li><a class="nav" href="{{ route('logout') }}">Sair do sistema</a></li>
        </ul>
        <ul>
            <a href="{{route('inicioAdm')}}"><img src="/imagens/logo_index.png" alt="Logo do sistema earsphant com um elefante com as orelhas abertas"></a>
        </ul>
    </nav>
</header>

<script>
    // Function to toggle dropdown
    function toggleDropdown(dropdownId) {
        var dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle("show");
        // Close other dropdowns
        var dropdowns = document.querySelectorAll('.dropdown-content, .dropdown-content2, .dropdown-content3');
        dropdowns.forEach(function(drop) {
            if (drop.id !== dropdownId && drop.classList.contains('show')) {
                drop.classList.remove('show');
            }
        });
    }

    // Close dropdowns if the user clicks outside of them
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn') && !event.target.matches('.dropbtn2') && !event.target.matches('.dropbtn3')) {
            var dropdowns = document.querySelectorAll('.dropdown-content, .dropdown-content2, .dropdown-content3');
            dropdowns.forEach(function(drop) {
                if (drop.classList.contains('show')) {
                    drop.classList.remove('show');
                }
            });
        }
    }
</script>
