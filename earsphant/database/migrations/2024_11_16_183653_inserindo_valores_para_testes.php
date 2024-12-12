<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Adicionar valores no setor
        DB::table('setores')->insert([
        [
            'nome' => 'Tecnologia da Informação',
            'codigo' => '001', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nome' => 'Adminstração',
            'codigo' => '002', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nome' => 'Gestão de Pessoas',
            'codigo' => '003', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nome' => 'Financeiro',
            'codigo' => '004', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        ]);

        // Adicionar valores no setor
        DB::table('usuarios')->insert([
        [
            'nome' => 'Usuario',
            'login' => 'user',
            'senha' => 'user',
            'setor' => '003',
            'acesso' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nome' => 'Administrador',
            'login' => 'admin',
            'senha' => 'admin',
            'setor' => '001',
            'acesso' => '3', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nome' => 'Técnico',
            'login' => 'tec',
            'senha' => 'tec',
            'setor' => '001',
            'acesso' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
