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
        // Tabela de setores, a coluna 'codigo' é uma chave candidata
        Schema::create('setores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('codigo')->unique();
            $table->string('nome', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setores');
    }
};
