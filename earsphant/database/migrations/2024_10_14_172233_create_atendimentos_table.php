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
        // tabela de atendimentos, coluna 'codigo' é uma chave candidata
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('setor')->nullable();
            $table->string('usuario');
            $table->unsignedBigInteger('codigo')->unique();
            $table->string('servico');
            $table->string('subservico', 50)->nullable();
            $table->string('status', 20);
            $table->string('fila', 20);
            $table->text('descricao');
            $table->dateTime('abertura');
            $table->dateTime('fechamento')->nullable();
            $table->dateTime('ans')->nullable();
            $table->string('encarregado')->nullable();
            $table->string('prioridade', 30)->nullable();
            $table->string('equipamento', 30)->nullable();
            $table->string('programa', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendimentos');
    }
};
