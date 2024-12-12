<footer>

    <p>Sistema de Tickets de Atendimento - Earsphant 2024</p>

    <div id="tempo_data"></div>

    <script>
        function atualizarDataHora() {
            var agora = new Date();
            var dataHoraFormatada = agora.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
            document.getElementById('tempo_data').innerHTML = dataHoraFormatada;
        }

        setInterval(atualizarDataHora, 10000); // Atualiza a cada 10 segundos
        atualizarDataHora(); // Atualiza imediatamente ao carregar a página
    </script>
</footer>