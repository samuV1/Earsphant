<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Dados para o dashboard
        $recentAtendimentos = Atendimento::where('status', 'Aberto')
            ->orderBy('abertura', 'desc')
            ->take(5)
            ->get();
        $totalCriados = Atendimento::count();
        $abertos = Atendimento::where('status', 'Aberto')->count();
        $fechados = Atendimento::where('status', 'Fechado')->count();
        $emAtendimento = Atendimento::where('status', 'Em Atendimento')->count();

        $atendimentosPorSetor = Atendimento::join('setores', 'setores.codigo', '=', 'atendimentos.setor')
            ->selectRaw('setores.nome as setor, count(*) as total')
            ->groupBy('setores.nome')
            ->get();

        // Calcular a média de dias entre a abertura e fechamento
        $fechadosAtendimentos = Atendimento::where('status', 'Fechado')->get();
        $totalDias = 0;
        $contagem = 0;

        foreach ($fechadosAtendimentos as $atendimento) {
            if ($atendimento->abertura && $atendimento->fechamento) {
                $abertura = Carbon::parse($atendimento->abertura);
                $fechamento = Carbon::parse($atendimento->fechamento);
                $diasGastos = $abertura->diffInDays($fechamento);
                $totalDias += $diasGastos;
                $contagem++;
            }
        }

        $mediaDias = $contagem > 0 ? $totalDias / $contagem : 0;

        // Total de chamados abertos
        $totalAbertos = Atendimento::whereNull('fechamento')->count();

        // Total resolvido no mês
        $totalResolvidosNoMes = Atendimento::whereMonth('fechamento', Carbon::now()->month)
            ->whereYear('fechamento', Carbon::now()->year)
            ->count();


        // Percentual de SLA cumprido
        $atendimentosComSLA = Atendimento::whereNotNull('fechamento')
            ->get();

        $totalSLAComprovado = 0;
        foreach ($atendimentosComSLA as $atendimento) {
            $abertura = Carbon::parse($atendimento->abertura);
            $fechamento = Carbon::parse($atendimento->fechamento);
            $ans = $atendimento->ans;

            // Se a diferença entre abertura e fechamento for menor ou igual ao ANS, o SLA foi cumprido
            if ($abertura->diffInMinutes($fechamento) <= $ans) {
                $totalSLAComprovado++;
            }
        }

        $totalAtendimentosComSLA = $atendimentosComSLA->count();
        $percentualSLA = ($totalSLAComprovado / $totalAtendimentosComSLA) * 100;

        // Chamados abertos ao longo do tempo
        $chamadosAbertos = Atendimento::select(DB::raw('DATE(abertura) as data'), DB::raw('count(*) as quantidade'))
            ->where('status', 'Aberto')
            ->groupBy(DB::raw('DATE(abertura)'))
            ->orderBy('data', 'asc')
            ->get();

        $fechadosAoLongoDoTempo = Atendimento::select(DB::raw('DATE(fechamento) as data'), DB::raw('count(*) as quantidade'))
            ->where('status', 'Fechado')
            ->groupBy(DB::raw('DATE(fechamento)'))
            ->orderBy('data', 'asc')
            ->get();

        // Retorna a view com os dados
        return view('administrador.inicio', compact(
            'recentAtendimentos',
            'abertos',
            'fechados',
            'emAtendimento',
            'atendimentosPorSetor',
            'mediaDias',
            'totalAbertos',
            'totalResolvidosNoMes',
            'percentualSLA',
            'totalSLAComprovado',
            'totalCriados',
            'chamadosAbertos',
            'fechadosAoLongoDoTempo'
        ));
    }
}
