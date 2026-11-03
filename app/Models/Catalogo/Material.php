<?php

namespace App\Models\Catalogo;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    // Força o Laravel a usar o nome da tabela em português
    protected $table = 'materiais';

    // Libera os campos para salvamento seguro no banco de dados
   protected $fillable = [
        'codigo',
        'descricao',
        'cor',
        'tipo',
        'unidade_medida',
        'tamanho_padrao_mm',
        'peso_por_metro',
        'preco_custo',
        'imagem'
    ];
}