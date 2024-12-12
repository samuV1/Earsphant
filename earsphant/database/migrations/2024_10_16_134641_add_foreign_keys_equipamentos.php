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
        Schema::table('equipamento_atendimentos', function (Blueprint $table) {
            $table->foreign('equipamento')  
                  ->references('patrimonio')->on('equipamentos')
                  ->onDelete('cascade');
        });

        Schema::table('atendimentos', function (Blueprint $table) {
            $table->foreign('equipamento')  
                  ->references('patrimonio')->on('equipamentos')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipamento_atendimentos', function (Blueprint $table) {
            // Remove a chave estrangeira ao desfazer a migration
            $table->dropForeign(['equipamento']);
        });

        Schema::table('atendimentos', function (Blueprint $table) {
            // Remove a chave estrangeira ao desfazer a migration
            $table->dropForeign(['equipamento']);
        }); 
    }
};
