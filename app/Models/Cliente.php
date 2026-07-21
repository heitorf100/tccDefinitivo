<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    /**
     * Define o nome da tabela no banco de dados explicitamente.
     */
    protected $table = 'clientes';

    /**
     * Os atributos que podem ser atribuídos em massa (Mass Assignment).
     */
    protected $fillable = [
        'nome_razao',
        'cpf_cnpj',
        'tipo_pessoa',
        'data_cadastro',
    ];

    /**
     * Os atributos que devem ser convertidos (Casts).
     */
    protected $casts = [
        'data_cadastro' => 'datetime',
    ];

    /* 
     * ==================================================================
     * RELACIONAMENTOS
     * ==================================================================
     */

    /**
     * Um cliente possui muitos endereços (Endereço fiscal, de entrega ou de obras).
     * 
     * @return HasMany
     */
    public function enderecos(): HasMany
    {
        return $this->hasMany(Endereco::class, 'cliente_id');
    }

    /**
     * Um cliente possui muitas formas de contato cadastradas.
     * 
     * @return HasMany
     */
    public function contatos(): HasMany
    {
        return $this->hasMany(Contato::class, 'cliente_id');
    }
}