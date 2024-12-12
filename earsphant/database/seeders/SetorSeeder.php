<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setor;
class SetorSeeder extends Seeder
{
    public function run()
    {
       
        \App\Models\Setor::create([
            'codigo' => 1,
            'nome' => 'TI',
        ]);

        \App\Models\Setor::create([
            'codigo' => 2,
            'nome' => 'Atendimento ao Cliente',
        ]);

        \App\Models\Setor::create([
            'codigo' => 3,
            'nome' => 'Vendas',
        ]);

        \App\Models\Setor::create([
            'codigo' => 4,
            'nome' => 'Financeiro',
        ]);

        \App\Models\Setor::create([
            'codigo' => 5,
            'nome' => 'Marketing',
        ]);

       
    }
}
