<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contato extends Model
{
    use HasFactory;

    /**
     * Define o nome da tabela explicitamente.
     */
    protected $table = 'contatos';

    /**
     * Proteção contra Mass Assignment.
     */
    protected $fillable = [
        'cliente_id',
        'tipo_contato',
        'valor',
        'descricao',
    ];

    /* 
     * ==================================================================
     * RELACIONAMENTOS
     * ==================================================================
     */

    /**
     * Um contato sempre pertence a um Cliente.
     * 
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}