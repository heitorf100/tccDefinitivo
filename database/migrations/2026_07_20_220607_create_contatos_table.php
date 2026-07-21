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
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            
            // Relacionamento Estrutural com Clientes
            $table->foreignId('cliente_id')
                  ->constrained('clientes')
                  ->onDelete('cascade');
            
            // Limitando os tipos para manter o banco padronizado
            $table->enum('tipo_contato', ['Telefone', 'Celular', 'WhatsApp', 'Email']);
            
            $table->string('valor', 100);
            
            // Tornamos a descrição anulável (opcional)
            $table->string('descricao', 50)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatos');
    }
};