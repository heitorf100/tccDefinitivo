<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
{
    /**
     * Determine se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        // Retornamos true pois a autorização de rotas/perfis faremos em outra camada
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome_razao'  => ['required', 'string', 'max:150'],
            'cpf_cnpj'    => ['required', 'string', 'max:20', 'unique:clientes,cpf_cnpj'],
            'tipo_pessoa' => ['required', 'in:PF,PJ'],
        ];
    }

    /**
     * Mensagens de erro personalizadas para uma melhor experiência de uso.
     */
    public function messages(): array
    {
        return [
            'nome_razao.required'  => 'O campo Nome ou Razão Social é obrigatório.',
            'nome_razao.max'       => 'O nome não pode exceder 150 caracteres.',
            'cpf_cnpj.required'    => 'O CPF ou CNPJ é obrigatório.',
            'cpf_cnpj.unique'      => 'Este CPF ou CNPJ já está cadastrado no sistema.',
            'tipo_pessoa.required' => 'Informe se o cadastro é Pessoa Física (PF) ou Jurídica (PJ).',
            'tipo_pessoa.in'       => 'O tipo de pessoa deve ser obrigatoriamente PF ou PJ.',
        ];
    }
}