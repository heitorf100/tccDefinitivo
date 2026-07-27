<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enderecos', function (Blueprint $table) {
            // Adiciona a coluna logo após o cliente_id para ficar organizado no banco
            $table->string('identificador_obra', 100)
                  ->nullable()
                  ->after('cliente_id')
                  ->comment('Ex: Residencial Alphaville - Lote 15');
        });
    }

    public function down(): void
    {
        Schema::table('enderecos', function (Blueprint $table) {
            // Remove a coluna caso precisemos reverter a migração no futuro
            $table->dropColumn('identificador_obra');
        });
    }
};