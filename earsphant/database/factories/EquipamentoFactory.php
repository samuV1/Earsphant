<?php

namespace Database\Factories;

use App\Models\Equipamento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EquipamentoFactory extends Factory
{
    protected $model = Equipamento::class;

    public function definition()
    {
        return [
            'setor' => $this->faker->numberBetween(1, 3), // Associa um setor aleatório entre 1 e 3
            'tipo' => substr($this->faker->word, 0, 20), // Garante que o valor tenha no máximo 20 caracteres
            'marca' => substr($this->faker->company, 0, 20),
            'modelo' => substr($this->faker->word, 0, 20),
            'patrimonio' => $this->faker->unique()->randomNumber(7, true), // Gera um número de 7 dígitos
            'aquisicao' => $this->faker->date(), // Gera uma data aleatória para aquisição
            'alugado' => $this->faker->boolean, // Gera um valor booleano (true/false) para se o equipamento é alugado
            'fornecedor' => substr($this->faker->company, 0, 20),
        ];
    }
}
