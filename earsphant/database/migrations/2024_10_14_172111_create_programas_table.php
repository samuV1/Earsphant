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
        // tabela para inventário de programas, coluna 'codigo' é uma chave candidata, para númeração interna
        Schema::create('programas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo', 30)->unique();
            $table->string('licenca', 50)->nullable();
            $table->string('nome', 30);
            $table->string('fornecedor', 30)->nullable();
            $table->string('versao', 30)->nullable();
            $table->date('aquisicao')->nullable();
            $table->boolean('terceiros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programas');
    }
};
