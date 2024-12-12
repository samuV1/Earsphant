@extends('base')

@section('title', 'Início')

@section('estilo_pagina_css')
    <link rel="stylesheet" href={{ asset('css/modulo_administrador/home.css') }}>
    <style>
        body {
            overflow-x: hidden; /* Remove horizontal scroll */
        }
    </style>
@endsection

@section('pagina')
    @include('administrador.cabecalho')

    <main class="elemento_pai">
        <h2>Monitoramento de Atendimentos e SLA</h2>

    <div  class=" container ">
    <div class="card">
    <div class="card-tile">
        <h3>Resumo dos Atendimentos</h3>
    </div>

    <div class="card-body">
        <p><strong>Total de Atendimentos Criados:</strong> <span class="destaque">{{ $totalCriados }}</span></p>
        <p><strong>Total de Atendimentos em Aberto:</strong> <span class="destaque">{{ $totalAbertos }}</span></p>
        <p><strong>Tickets Solucionados:</strong> <span class="destaque">{{ $fechados }}</span></p>
        <p><strong>Atendimentos Fechados Dentro do SLA:</strong> <span class="destaque">{{ $totalSLAComprovado }}</span></p>

        <p><strong>Total de Cumprimento do SLA:</strong> <span class="destaque">{{ number_format($percentualSLA) }}%</span></p>

        <h3>Média de Dias Entre Abertura e Fechamento</h3>
        <p><span class="destaque">{{ number_format($mediaDias, 2) }} dias</span></p>
    </div>
</div>

    <div class="card">
        <div class="card-title">Últimos atendimentos abertos</div>
        <div class="areaTicket">
                    @foreach ($recentAtendimentos as $atendimento)
                        <li class="pesquisa">
                            <strong class="pesquisa">Código:</strong> {{ $atendimento->codigo }} 
                            <strong class="pesquisa">| Servico:</strong> {{ $atendimento->servico }} 
                            <strong class="pesquisa">| Usuario:</strong> {{ $atendimento->usuario }} 
                            <a class="pesquisa" href="{{ route('atendimentoADM', $atendimento->codigo) }}">Ver detalhes</a>
                        </li>
                    @endforeach
        </div>
    </div>

    <div class="card">
    <div class="card-title"><h3>Status dos tickets</h3></div>
    <canvas id="pizza" aria-label="Gráfico de estatísticas" role="img"></canvas>
    </div>

    <div class="card">
    <div class="card-title"><h3>  <h3>Atendimentos por Setor</h3></div>
    <canvas id="setorChart"></canvas>
    </div>

    <div class="card">
        <div class="card-title"><h3>Chamados Abertos ao Longo do Tempo</h3></div>
        <canvas id="lineChart"></canvas>
    </div>
     
   
    
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
              const abertos = @json($abertos);
              const emAtendimento = @json($emAtendimento);
              const fechados = @json($fechados);
             
            document.addEventListener('DOMContentLoaded', () => {
                const ctx = document.getElementById('pizza');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Resolvidos', 'Abertos', 'Em atendimento'],
                        datasets: [{
                            label: 'Porcentagem de Categorias',
                            data: [fechados, abertos, emAtendimento],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)'
                            
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (tooltipItem) {
                                        const value = tooltipItem.raw;
                                        const total = tooltipItem.dataset.data.reduce((sum, val) => sum + val, 0);
                                        const percentage = ((value / total) * 100).toFixed(2);
                                        return `${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
        
<script>
    var ctx = document.getElementById('setorChart').getContext('2d');
    var setorChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach ($atendimentosPorSetor as $setor)
                    '{{ $setor->setor }}', 
                @endforeach
            ],
            datasets: [{
                label: 'Atendimentos por Setor',
                data: [
                    @foreach ($atendimentosPorSetor as $setor)
                        {{ $setor->total }},
                    @endforeach
                ],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const chamadosAbertos = @json($chamadosAbertos);
    const datas = chamadosAbertos.map(item => item.data);
    const quantidades = chamadosAbertos.map(item => item.quantidade);

    const fechadosAoLongoDoTempo = @json($fechadosAoLongoDoTempo);
    const datasFechados = fechadosAoLongoDoTempo.map(item => item.data);
    const quantidadesFechados = fechadosAoLongoDoTempo.map(item => item.quantidade);

    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: datas,
            datasets: [{
                label: 'Chamados Abertos',
                data: quantidades,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: true
            },
            {
                label: 'Chamados Fechados',
                data: quantidadesFechados,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
    </main>

    @include('administrador.rodape')
@endsection
