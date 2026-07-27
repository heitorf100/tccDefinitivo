<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->id();
            
            // Relacionamentos Estruturais
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            // Usamos restrict no endereço para não deletar sem querer o local de uma obra que tem orçamento aprovado
            $table->foreignId('endereco_id')->constrained('enderecos')->onDelete('restrict'); 
            
            // Controle de Datas
            $table->date('data_criacao'); 
            $table->date('data_validade')->nullable();
            
            // Regras de Negócio e Contrato
            $table->integer('prazo_entrega_dias')->nullable();
            $table->enum('tipo_servico', ['APENAS_PRODUCAO', 'PRODUCAO_E_INSTALACAO'])->default('PRODUCAO_E_INSTALACAO');
            $table->string('condicoes_pagamento', 255)->nullable();
            $table->integer('garantia_meses')->default(12);
            $table->text('observacoes_contratuais')->nullable();
            
            // Controle de Status e Valor
            $table->enum('status_pedido', ['ORCAMENTO', 'APROVADO', 'PRODUCAO', 'FINALIZADO', 'CANCELADO'])->default('ORCAMENTO');
            $table->decimal('valor_total', 10, 2)->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orcamentos');
    }
};