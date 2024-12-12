<footer>

    <p>Sistema de Tickets de Atendimento - Earsphant 2024</p>

    <div id="datetime"></div>

    <script>
        function atualizarDataHora() {
            var agora = new Date();
            var dataHoraFormatada = agora.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
            document.getElementById('datetime').innerHTML = dataHoraFormatada;
        }

        setInterval(atualizarDataHora, 10000); // Atualiza a cada 10 segundos
        atualizarDataHora(); // Atualiza imediatamente ao carregar a página
    </script>

<!--
    <p>Sistema de Tickets de Atendimento - Earsphant 2024</p>

    <div>@php/*
        date_default_timezone_set('America/Sao_Paulo');
        $agora = new DateTime(); // Pega o momento atual
        echo $agora->format('d/m/Y H:i'); // Exibe no formato desejado*/
    @endphp</div>


-->
</footer>