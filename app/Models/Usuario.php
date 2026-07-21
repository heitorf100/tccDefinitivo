<?php

namespace App\Models;

// Importante: Para o Laravel usar esta classe no login, ela deve estender Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Define o nome da tabela no banco de dados explicitamente.
     */
    protected $table = 'usuarios';

    /**
     * Os atributos que podem ser atribuídos em massa (Mass Assignment).
     */
    protected $fillable = [
        'nome',
        'login_email',
        'senha_hash',
        'cargo',
        'status_ativo',
    ];

    /**
     * Os atributos que devem estar ocultos nos arrays de retorno (Segurança).
     */
    protected $hidden = [
        'senha_hash',
    ];

    /**
     * Os atributos que devem ser convertidos (Casts).
     */
    protected $casts = [
        'status_ativo' => 'boolean',
    ];

    /**
     * Como mudamos o nome padrão da coluna de senha do Laravel ('password') para 'senha_hash',
     * precisamos avisar a classe de Autenticação sobre qual campo ela deve validar.
     */
    public function getAuthPassword()
    {
        return $this->senha_hash;
    }
}