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
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            
            // Relacionamento Estrutural: Chave Estrangeira (Foreign Key)
            $table->foreignId('cliente_id')
                  ->constrained('clientes')
                  ->onDelete('cascade');
            
            $table->string('logradouro', 150);
            $table->string('numero', 10);
            $table->string('bairro', 100);
            $table->string('cidade', 100);
            $table->char('estado', 2); // Ex: 'SP', 'RJ', 'PR'
            $table->string('cep', 9);
            
            // Defini os tipos básicos para o contexto do seu TCC
            $table->enum('tipo_endereco', ['Residencial', 'Comercial', 'Obra']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};