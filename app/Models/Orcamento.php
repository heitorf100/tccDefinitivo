<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    use HasFactory;

    protected $table = 'orcamentos';

    protected $fillable = [
        'cliente_id', 
        'endereco_id', 
        'data_criacao', 
        'data_validade',
        'prazo_entrega_dias', 
        'tipo_servico', 
        'condicoes_pagamento',
        'garantia_meses', 
        'observacoes_contratuais', 
        'status_pedido', 
        'valor_total'
    ];

    /**
     * Relacionamento: Um orçamento pertence a um Cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relacionamento: Um orçamento está vinculado a um Endereço (Obra).
     */
    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    /**
     * Relacionamento: Um orçamento possui vários Itens (vãos medidos).
     */
    public function itens()
    {
        return $this->hasMany(ItemProjeto::class);
    }
}