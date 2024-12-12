<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nota;
use App\Models\Atendimento;
use App\Models\Usuario;
use Faker\Factory as Faker;

class NotaSeeder extends Seeder
{
    public function run(): void
    {
        // Instancia o Faker para gerar dados aleatórios
        $faker = Faker::create();

        // Obtém todos os atendimentos existentes
        $atendimentos = Atendimento::all();

        // Obtém todos os usuários existentes
        $usuarios = Usuario::all();

        // Verifica se existem atendimentos e usuários para evitar falhas
        if ($atendimentos->isEmpty() || $usuarios->isEmpty()) {
            echo "Não há atendimentos ou usuários disponíveis para associar as notas.\n";
            return;
        }

        // Loop para criar 50 notas aleatórias
        foreach (range(1, 150) as $index) {
            // Seleciona um atendimento aleatório
            $atendimento = $atendimentos->random();

            // Seleciona um usuário aleatório
            $usuario = $usuarios->random();

            // Cria uma nova nota associando ao atendimento e usuário
            Nota::create([
                'atendimento' => $atendimento->codigo, // Usando o código do atendimento
                'usuario' => $usuario->login, // Usando o login do usuário
                'descricao' => $faker->sentence, // Gerando uma descrição aleatória
                'data' => $faker->dateTimeThisYear(), // Gerando uma data aleatória dentro deste ano
            ]);
        }
    }
}
