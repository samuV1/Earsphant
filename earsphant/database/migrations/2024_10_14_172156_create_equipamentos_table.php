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
        // tabela para inventário de equipamentos, coluna 'patrimonio' é uma chave candidata, para númeração interna
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('setor')->nullable();
            $table->string('tipo', 20);
            $table->string('marca', 20)->nullable();
            $table->string('modelo', 30)->nullable();
            $table->string('patrimonio', 30)->unique();
            $table->date('aquisicao');
            $table->boolean('alugado');
            $table->string('fornecedor', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipamentos');
    }
};
