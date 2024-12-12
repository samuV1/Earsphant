<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servico;

class ServicoSeeder extends Seeder
{
    public function run()
{
    // Criar 5 serviços
    Servico::create([
        'servico' => 'Serviço A',
        'status' => 'Ativo',
        'ans' => now()->format('H:i:s'),  // Hora atual no formato HH:MM:SS
    ]);

    Servico::create([
        'servico' => 'Serviço B',
        'status' => 'Ativo',
        'ans' => now()->addHours(2)->format('H:i:s'),  // Hora atual + 2 horas, formato HH:MM:SS
    ]);

    Servico::create([
        'servico' => 'Serviço C',
        'status' => 'Inativo',
        'ans' => now()->subMinutes(30)->format('H:i:s'),  // Hora atual - 30 minutos, formato HH:MM:SS
    ]);

    Servico::create([
        'servico' => 'Serviço D',
        'status' => 'Ativo',
        'ans' => '12:34:56',  // Um valor fixo de hora no formato HH:MM:SS
    ]);

    for ($i = 5; $i <= 10; $i++) {
        Servico::create([
            'servico' => 'Serviço ' . chr(64 + $i), // 'Serviço A', 'Serviço B', ...
            'status' => $i % 2 == 0 ? 'Ativo' : 'Inativo', // Alterna entre 'Ativo' e 'Inativo'
            'ans' => now()->addMinutes($i * 5)->format('H:i:s'),  // Hora atual + 5 minutos para cada serviço
        ]);
    }
}
}
