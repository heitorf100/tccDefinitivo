<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipologias', function (Blueprint $table) {
            $table->id();
            
            // O código de referência (ex: J2F, P3F) deve ser único para não haver confusão na fábrica
            $table->string('codigo_ref', 20)->unique(); 
            
            // Nome comercial que aparecerá para o cliente
            $table->string('nome', 100);
            
            // Detalhamento técnico limitando a 1000 caracteres (espaço de sobra para especificações, mas seguro para o PDF)
            $table->string('descricao', 1000)->nullable();
            
            // Caminho da imagem/croqui que o ADM fará o upload
            $table->string('imagem_url', 255)->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipologias');
    }
};