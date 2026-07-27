<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('itens_projeto', function (Blueprint $table) {
            $table->id();
            
            // Relacionamentos Estruturais
            // Se o orçamento for cancelado/excluído, os itens dele também serão (cascade)
            $table->foreignId('orcamento_id')->constrained('orcamentos')->onDelete('cascade');
            // Impede que o ADM exclua um modelo de esquadria (tipologia) que já esteja salvo em algum orçamento do cliente (restrict)
            $table->foreignId('tipologia_id')->constrained('tipologias')->onDelete('restrict');
            
            // Dados Físicos da Obra
            $table->string('ambiente_local', 100)->nullable()->comment('Ex: Sacada, Banheiro Suíte');
            // Dados Físicos da Obra em Milímetros (Ex: 6000 para 6 metros)
            $table->integer('largura_vao');
            $table->integer('altura_vao');
            $table->integer('profundidade_vao')->nullable();
            $table->integer('quantidade')->default(1);
            
            // Valores Financeiros Calculados
            $table->decimal('valor_unitario', 10, 2);
            $table->decimal('valor_subtotal', 10, 2); // quantidade * valor_unitario
            
            // Observações Específicas do Item
            $table->string('observacao_item', 255)->nullable()->comment('Ex: Vidro temperado fumê 8mm');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('itens_projeto');
    }
};