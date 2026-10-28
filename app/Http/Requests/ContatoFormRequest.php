<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatoFormRequest extends FormRequest
{
    /**
     * Determina se o utilizador está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação que se aplicam à requisição.
     */
    public function rules(): array
    {
        return [
            'tipo_contato' => ['required', 'in:Telefone,Celular,WhatsApp,Email'], // Trava do Enum
            'valor'        => ['required', 'string', 'max:100'],
            'descricao'    => ['nullable', 'string', 'max:50'],
        ];
    }
}