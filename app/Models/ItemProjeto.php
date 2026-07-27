<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemProjeto extends Model
{
    use HasFactory;

    protected $table = 'itens_projeto';

    protected $fillable = [
        'orcamento_id', 
        'tipologia_id', 
        'ambiente_local',
        'largura_vao', 
        'altura_vao', 
        'profundidade_vao',
        'quantidade', 
        'valor_unitario', 
        'valor_subtotal', 
        'observacao_item'
    ];

    /**
     * Relacionamento: Este item pertence a um Orçamento específico.
     */
    public function orcamento()
    {
        return $this->belongsTo(Orcamento::class);
    }

    /**
     * Relacionamento: Este item é baseado em um modelo de esquadria (Tipologia).
     */
    public function tipologia()
    {
        return $this->belongsTo(Tipologia::class);
    }
}