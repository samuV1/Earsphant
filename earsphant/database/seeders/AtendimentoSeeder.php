<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Atendimento;
use App\Models\Usuario;
use App\Models\Equipamento;
use App\Models\EquipamentoAtendimento;

class AtendimentoSeeder extends Seeder
{
    public function run(): void
    {
        // Seleciona 10 usuários aleatórios
        $usuarios = Usuario::inRandomOrder()->limit(10)->get();
        
        // Cria 30 atendimentos para cada usuário
        foreach ($usuarios as $usuario) {
            // Cria os atendimentos e os armazena em uma variável
            for ($i = 0; $i < 30; $i++) {
                $lastCodigo = Atendimento::max('codigo') ?? 0;
                $codigo = $lastCodigo + 1;

                $atendimento = Atendimento::factory()->create([
                    'setor' => $usuario->setor, // Mesmo setor do usuário
                    'usuario' => $usuario->login, // Referenciando o login do usuário
                    'codigo' => $codigo,
                ]);
                
                // Associa aleatoriamente equipamentos a este atendimento
                $equipamentos = Equipamento::all(); // Carrega todos os equipamentos

                // Número aleatório de associações para cada atendimento
                $associacoes = rand(1, 3);

                // Seleciona equipamentos aleatórios para associar
                $equipamentosAleatorios = $equipamentos->random($associacoes);

                foreach ($equipamentosAleatorios as $equipamento) {
                    EquipamentoAtendimento::create([
                        'equipamento' => $equipamento->patrimonio,
                        'atendimento' => $atendimento->codigo,  
                    ]);
                }
            }
        }
    }
}
