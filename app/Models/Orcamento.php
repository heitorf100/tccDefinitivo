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
        'valor_total',
    ];

    protected $casts = [
        'data_criacao'       => 'date',
        'data_validade'      => 'date',
        'prazo_entrega_dias' => 'integer',
        'garantia_meses'     => 'integer',
        'valor_total'        => 'decimal:2',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemProjeto::class);
    }
}