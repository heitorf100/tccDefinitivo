<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioFormRequest extends FormRequest
{
    /**
     * Determine se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true; // A autorização de quem pode criar usuários será feita por rotas protegidas depois
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'nome'          => ['required', 'string', 'max:100'],
        'login_email'   => ['required', 'email', 'max:100', 'unique:usuarios,login_email'],
        // Validamos 'senha' e exigimos 'confirmed' para conferir com 'senha_confirmation'
        'senha'         => ['required', 'string', 'min:6', 'max:32', 'confirmed'],
        'cargo'         => ['required', 'in:ADM,PROD'],
        'status_ativo'  => ['nullable', 'boolean'],
    ];
}

    /**
     * Mensagens de erro personalizadas.
     */
    public function messages(): array
{
    return [
        'nome.required'        => 'O nome completo é obrigatório.',
        'login_email.required' => 'O e-mail de acesso é obrigatório.',
        'login_email.email'    => 'Informe um e-mail válido.',
        'login_email.unique'   => 'Este e-mail já está cadastrado no sistema.',
        'senha.required'       => 'A senha é obrigatória.',
        'senha.min'            => 'A senha deve ter no mínimo 6 caracteres.',
        'senha.max'            => 'A senha não pode ultrapassar 32 caracteres.',
        'senha.confirmed'      => 'A confirmação de senha não confere.',
        'cargo.required'       => 'Selecione o cargo do usuário.',
        'cargo.in'             => 'O cargo selecionado é inválido.',
    ];
}
}