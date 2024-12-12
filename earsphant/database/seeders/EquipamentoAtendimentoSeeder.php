<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipamento;
use App\Models\Atendimento;
use App\Models\EquipamentoAtendimento;

class EquipamentoAtendimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar se existem registros suficientes em Equipamentos e Atendimentos
        $equipamentos = Equipamento::all();
        $atendimentos = Atendimento::all();

        if ($equipamentos->isEmpty() || $atendimentos->isEmpty()) {
            $this->command->warn('Certifique-se de que as tabelas Equipamentos e Atendimentos possuam registros antes de rodar este Seeder.');
            return;
        }

        // Associa randomicamente equipamentos a atendimentos
        foreach ($atendimentos as $atendimento) {
            // Número aleatório de associações para cada atendimento
            $associacoes = rand(1, 3);

            // Seleciona equipamentos aleatórios para associar
            $equipamentosAleatorios = $equipamentos->random($associacoes);

            foreach ($equipamentosAleatorios as $equipamento) {
                EquipamentoAtendimento::create([
                    'equipamento' => $equipamento->id,
                    'atendimento' => $atendimento->id,
                ]);
            }
        }
    }
}
