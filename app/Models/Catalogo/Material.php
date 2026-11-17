<?php

namespace App\Models\Catalogo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiais';

    protected $fillable = [
        'codigo',
        'descricao',
        'cor',
        'tipo',
        'unidade_medida',
        'tamanho_padrao_mm',
        'peso_por_metro',
        'preco_custo',
        'imagem',
    ];

    protected $casts = [
        'tamanho_padrao_mm' => 'integer',
        'peso_por_metro'    => 'decimal:3',
        'preco_custo'       => 'decimal:2',
    ];
}