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
        'observacao_item',
    ];

    protected $casts = [
        'largura_vao'      => 'integer',
        'altura_vao'       => 'integer',
        'profundidade_vao' => 'integer',
        'quantidade'       => 'integer',
        'valor_unitario'   => 'decimal:2',
        'valor_subtotal'   => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::saving(function (ItemProjeto $item) {
            $item->valor_subtotal = round($item->quantidade * $item->valor_unitario, 2);
        });

        static::saved(function (ItemProjeto $item) {
            $item->recalcularTotalOrcamento();
        });

        static::deleted(function (ItemProjeto $item) {
            $item->recalcularTotalOrcamento();
        });
    }

    public function recalcularTotalOrcamento(): void
    {
        if ($this->orcamento) {
            $total = $this->orcamento->itens()->sum('valor_subtotal');
            $this->orcamento->update(['valor_total' => $total]);
        }
    }

    public function orcamento()
    {
        return $this->belongsTo(Orcamento::class);
    }

    public function tipologia()
    {
        return $this->belongsTo(Tipologia::class);
    }
}