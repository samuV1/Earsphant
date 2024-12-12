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
        Schema::table('anexos', function (Blueprint $table) {
            $table->foreign('atendimento')  
                  ->references('codigo')->on('atendimentos')  
                  ->onDelete('cascade');  
        });

        Schema::table('notas', function (Blueprint $table) {
            $table->foreign('atendimento')  
                  ->references('codigo')->on('atendimentos')  
                  ->onDelete('cascade');  
        });

        Schema::table('programa_atendimentos', function (Blueprint $table) {
            $table->foreign('atendimento')  
                  ->references('codigo')->on('atendimentos')
                  ->onDelete('cascade');
        });

        Schema::table('equipamento_atendimentos', function (Blueprint $table) {
            $table->foreign('atendimento')  
                  ->references('codigo')->on('atendimentos')
                  ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anexos', function (Blueprint $table) {
            // Remove a chave estrangeira ao desfazer a migration
            $table->dropForeign(['atendimento']);
        });

        Schema::table('notas', function (Blueprint $table) {
            // Remove a chave estrangeira ao desfazer a migration
            $table->dropForeign(['atendimento']);
        });

        Schema::table('programa_atendimentos', function (Blueprint $table) {
            // Remove a chave estrangeira ao desfazer a migration
            $table->dropForeign(['atendimento']);
        });

        Schema::table('equipamento_atendimentos', function (Blueprint $table) {
            // Remove a chave estrangeira ao desfazer a migration
            $table->dropForeign(['atendimento']);
        });
    }
};
