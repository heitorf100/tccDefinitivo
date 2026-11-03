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
        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique()->comment('Código no catálogo (Ex: SU-001)');
            $table->string('descricao', 150)->comment('Nome da peça');
            $table->string('cor', 50)->nullable()->comment('Acabamento ou cor');
            $table->enum('tipo', ['Perfil', 'Acessório', 'Vidro', 'Diversos']);
            $table->enum('unidade_medida', ['Barra', 'Metro', 'M2', 'Unidade']);
            $table->integer('tamanho_padrao_mm')->nullable()->comment('Tamanho em mm (ex: 6000 para barras)');
            $table->decimal('peso_por_metro', 8, 3)->nullable()->comment('Peso em KG');
            $table->decimal('preco_custo', 10, 2)->default(0);
            $table->string('imagem')->nullable()->comment('Caminho da imagem do produto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
