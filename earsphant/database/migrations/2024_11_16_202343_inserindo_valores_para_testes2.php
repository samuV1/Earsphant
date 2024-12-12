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
        //
        DB::table('servicos')->insert([
            [
                'servico' => 'Programas',
                'status' => 'ativo',
                'ans' => null,
            ],
            [
                'servico' => 'Permissões',
                'status' => 'user',
                'ans' => null,
            ],
            [
                'servico' => 'Internet',
                'status' => 'ativo',
                'ans' => null,
            ],
            ]);

        DB::table('atendimentos')->insert([
        [
            'setor' => '003',
            'usuario' => 'user',
            'codigo' => '1',
            'servico' => 'Programas',
            'subservico' => 'Instalação',
            'status' => 'Finalizado',
            'fila' => 'Resolvidas',
            'descricao' => 'Instalar libreoffice em todas as estações do setor',
            'abertura' => '2024-11-16 10:30:45',
            'fechamento' => '2024-11-16 17:30:00',
            'ans' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'setor' => '001',
            'usuario' => 'tec',
            'codigo' => '2',
            'servico' => 'Permissões',
            'subservico' => 'Usuário',
            'status' => 'Em atendimento',
            'fila' => 'Suporte',
            'descricao' => 'Criar a novo usuário login l34567, setor administração, nome José Carlos',
            'abertura' => '2024-11-16 10:40:45',
            'fechamento' => null,
            'ans' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'setor' => '003',
            'usuario' => 'user',
            'codigo' => '3',
            'servico' => 'Internet',
            'subservico' => 'Rede',
            'status' => 'Aberto',
            'fila' => 'Abertas',
            'descricao' => 'A internet parou de funcionar em todo o setor',
            'abertura' => '2024-11-16 10:45:45',
            'fechamento' => null,
            'ans' => null,
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
