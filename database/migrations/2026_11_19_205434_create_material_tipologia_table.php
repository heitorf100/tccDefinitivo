<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_tipologia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipologia_id')->constrained('tipologias')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('materiais')->onDelete('restrict');
            $table->enum('tipo_calculo', ['LARGURA', 'ALTURA', 'AREA', 'UNIDADE']);
            $table->integer('quantidade_pecas')->default(1);
            $table->integer('desconto_largura_mm')->default(0);
            $table->integer('desconto_altura_mm')->default(0);
            $table->string('observacao_corte', 150)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_tipologia');
    }
};