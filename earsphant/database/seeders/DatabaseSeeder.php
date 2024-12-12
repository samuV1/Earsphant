<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

       DB::statement('SET CONSTRAINTS ALL DEFERRED;');

       // Truncar as tabelas para limpar os dados
       Schema::disableForeignKeyConstraints();
       
       // Apagar todos os registros das tabelas
       DB::table('atendimentos')->truncate();
       DB::table('usuarios')->truncate();
       DB::table('setores')->truncate();
       DB::table('equipamentos')->truncate();
       DB::table('programas')->truncate();
       DB::table('notas')->truncate();
       DB::table('servicos')->truncate();
       DB::table('equipamento_atendimentos')->truncate();
       DB::table('programa_atendimentos')->truncate();

      
      

       // Reabilitar a verificação de chaves estrangeiras após o truncamento
       Schema::enableForeignKeyConstraints();
       
       DB::statement('SET CONSTRAINTS ALL IMMEDIATE;');

      
        $this->call(SetorSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(EquipamentoSeeder::class);
        $this->call(ProgramaSeeder::class);
        $this->call(AtendimentoSeeder::class);
        $this->call(NotaSeeder::class);
        $this->call(ServicoSeeder::class);
        $this->call(ProgramaAtendimentoSeeder::class);


     


    }
}
