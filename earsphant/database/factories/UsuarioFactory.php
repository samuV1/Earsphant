<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition()
    {
        return [
            'login' => $this->faker->unique()->userName, // Gera um nome de usuário único
            'senha' => bcrypt('password123'), // Gera uma senha criptografada
            'nome' => $this->faker->name, // Gera um nome aleatório
            'setor' => $this->faker->numberBetween(1, 5), // setor aleatório de 1 a 5
            'acesso' => $this->faker->numberBetween(0, 3), // Acesso aleatório de 1 a 3
            'url_foto' => null
        ];
    }
}
