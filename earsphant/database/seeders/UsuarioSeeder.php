<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario; // Importação do modelo Usuario

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criação dos usuários específicos
        Usuario::create([
            'nome' => 'Usuario',
            'login' => 'user',
            'senha' => 'user', // Criptografa a senha
            'setor' => '003',
            'acesso' => '0',
            'url_foto' => null, // Campo opcional, pode ser null
        ]);

        Usuario::create([
            'nome' => 'Administrador',
            'login' => 'admin',
            'senha' => 'admin', // Criptografa a senha
            'setor' => '001',
            'acesso' => '3',
            'url_foto' => null, // Campo opcional, pode ser null
        ]);

        Usuario::create([
            'nome' => 'Técnico',
            'login' => 'tec',
            'senha' => 'tec', // Criptografa a senha
            'setor' => '001',
            'acesso' => '1',
            'url_foto' => null, // Campo opcional, pode ser null
        ]);

        // Geração de 50 registros adicionais com a factory
        Usuario::factory(10)->create();
    }
}