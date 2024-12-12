<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Atendimento;
use App\Models\Usuario;

class AtendimentoFactory extends Factory
{
    protected $model = Atendimento::class;

    public function definition()
    {
            // Sorteia o status entre 'aberto' e 'fechado'
            $status = $this->faker->randomElement(['Aberto', 'Fechado','Em Atendimento']);
            
            $fechamento = null;

            if ($status === 'Fechado') {
                // Gera uma data de fechamento aleatória dentro de um ano a partir de 'abertura'
                $fechamento = $this->faker->dateTimeBetween('-1 year', 'now');
                $fila = "Fechado";
            } elseif ($status === 'Em Atendimento')
            {
                $fila = $this->faker->randomElement([
                    
                    '1',
                    '2',
                    '3'
                    
                ]);
            }else{
                $fila = "Aberto";
            }
                       
        return [
         
            'servico' => $this->faker->word, // Palavra aleatória para o serviço
            'subservico' => $this->faker->word, // Palavra aleatória para o subserviço
            'status' => $status,
            'fila' => $fila, // A fila é selecionada aleatoriamente
            'descricao' => $this->faker->sentence, // Descrição aleatória do atendimento
            'abertura' => now(),
            'fechamento' => $fechamento, // Preenche a data de fechamento com data aleatória, se necessário
            'ans' => now()->addDays(rand(1, 5)),
            'encarregado' => $this->faker->name, // Nome aleatório para o encarregado
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
