<?php

namespace App\Models;

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
        'imagem_url'
    ];

    /**
     * Relacionamento: Uma tipologia pode estar presente em vários itens de projeto (orçamentos).
     */
    public function itens()
    {
        return $this->hasMany(ItemProjeto::class);
    }
}