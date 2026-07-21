<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endereco extends Model
{
    use HasFactory;

    /**
     * Define o nome da tabela no banco de dados explicitamente.
     */
    protected $table = 'enderecos';

    /**
     * Os atributos que podem ser atribuídos em massa.
     */
    protected $fillable = [
        'cliente_id',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'tipo_endereco',
    ];

    /* 
     * ==================================================================
     * RELACIONAMENTOS (Design Pattern: Active Record / Data Mapper)
     * ==================================================================
     */

    /**
     * Um endereço pertence a um Cliente.
     * 
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}