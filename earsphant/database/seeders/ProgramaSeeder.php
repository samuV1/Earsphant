<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Programa;

class ProgramaSeeder extends Seeder
{
    public function run()
    {
        Programa::factory(50)->create(); // Cria 50 programas
    }
}
