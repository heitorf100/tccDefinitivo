<?php

namespace App\Models;

use App\Models\Catalogo\Material;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipologia extends Model
{
    use HasFactory;

    protected $table = 'tipologias';

    protected $fillable = [
        'codigo_ref',
        'nome',
        'descricao',
        'imagem_url',
    ];

    public function itens()
    {
        return $this->hasMany(ItemProjeto::class);
    }

    public function materiais()
    {
        return $this->belongsToMany(Material::class, 'material_tipologia', 'tipologia_id', 'material_id')
            ->withPivot([
                'id',
                'tipo_calculo',
                'quantidade_pecas',
                'desconto_largura_mm',
                'desconto_altura_mm',
                'observacao_corte',
            ])
            ->withTimestamps();
    }
}