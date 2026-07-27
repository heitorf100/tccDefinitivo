<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TipologiaFormRequest extends FormRequest
{
    /**
     * Determina se o usuário tem permissão para fazer essa requisição.
     */
    public function authorize(): bool
    {
        return true; // Liberado por enquanto. Futuramente, protegeremos a rota para aceitar apenas perfil 'ADM'.
    }

    /**
     * Regras de validação que serão aplicadas.
     */
    public function rules(): array
    {
        // Captura o ID da URL caso o usuário esteja editando um modelo já existente
        $tipologiaId = $this->route('id'); 

        return [
            'codigo_ref' => [
                'required',
                'string',
                'max:20',
                // Garante que o código é único, mas ignora a regra se estivermos apenas atualizando o próprio modelo
                Rule::unique('tipologias', 'codigo_ref')->ignore($tipologiaId),
            ],
            'nome'       => ['required', 'string', 'max:100'],
            'descricao'  => ['nullable', 'string', 'max:1000'],
            'imagem_url' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Mensagens de erro personalizadas para o usuário.
     */
    public function messages(): array
    {
        return [
            'codigo_ref.required' => 'O código de referência é obrigatório.',
            'codigo_ref.unique'   => 'Este código de referência já está cadastrado no sistema.',
            'nome.required'       => 'O nome da esquadria é obrigatório.',
            'descricao.max'       => 'A descrição técnica não pode ultrapassar 1000 caracteres.',
        ];
    }
}