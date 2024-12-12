<?php

namespace Database\Factories;

use App\Models\Programa;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramaFactory extends Factory
{
    protected $model = \App\Models\Programa::class;

    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->numberBetween(10000, 99999), // Gera um número entre 10000 e 99999
            'licenca' => $this->faker->word(), // Palavra simples
            'nome' => substr($this->faker->sentence(2), 0, 30), // Limita o nome a 30 caracteres
            'fornecedor' => substr($this->faker->company, 0, 30), // Limita a 30 caracteres
            'versao' => $this->faker->numerify('v#.#.#'), // Exemplo: v1.2.3
            'aquisicao' => $this->faker->date(),
            'terceiros' => $this->faker->boolean(),
        ];
    }
}

