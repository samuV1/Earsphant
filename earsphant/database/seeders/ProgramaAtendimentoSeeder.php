<?php

namespace Database\Seeders;

use App\Models\Atendimento;
use App\Models\Programa;
use App\Models\ProgramaAtendimento;
use Illuminate\Database\Seeder;

class ProgramaAtendimentoSeeder extends Seeder
{
    public function run(): void
    {
        // Seleciona todos os programas
        $programas = Programa::all();
        
        // Seleciona todos os atendimentos
        $atendimentos = Atendimento::all();
        
        // Para cada atendimento, associamos de 1 a 3 programas aleatórios
        foreach ($atendimentos as $atendimento) {
            // Número aleatório de programas para associar a cada atendimento
            $programasAleatorios = $programas->random(rand(1, 3));
            
            foreach ($programasAleatorios as $programa) {
                ProgramaAtendimento::create([
                    'programa' => $programa->codigo, // ID do programa
                    'atendimento' => $atendimento->codigo, // ID do atendimento
                ]);
            }
        }
    }
}
