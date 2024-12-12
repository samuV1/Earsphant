<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->foreign('setor')  
                  ->references('codigo')->on('setores')  
                  ->onDelete('set null');  
        });

        Schema::table('atendimentos', function (Blueprint $table) {
            $table->foreign('setor')  
                  ->references('codigo')->on('setores')  
                  ->onDelete('set null');  
        });

        Schema::table('equipamentos', function (Blueprint $table) {

            $table->foreign('setor')  
                  ->references('codigo')->on('setores')  
                  ->onDelete('set null');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Remove a chave estrangeira ao desfazer a migration
            $table->dropForeign(['setor']);
        });

        Schema::table('atendimentos', function (Blueprint $table) {
            // Remove a chave estrangeira ao desfazer a migration
            $table->dropForeign(['setor']);
        });

        Schema::table('equipamentos', function (Blueprint $table) {
            // Remove a chave estrangeira ao desfazer a migration
            $table->dropForeign(['setor']);
        });
    }
};
