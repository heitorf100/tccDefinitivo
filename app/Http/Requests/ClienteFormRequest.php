<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\CpfCnpj;

class ClienteFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $clienteId = $this->route('id');

        return [
            'nome_razao'  => ['required', 'string', 'max:150'],
            'cpf_cnpj'    => [
                'required',
                'string',
                'max:20',
                Rule::unique('clientes', 'cpf_cnpj')->ignore($clienteId),
                new CpfCnpj(),
            ],
            'tipo_pessoa' => ['required', 'in:PF,PJ'],
        ];
    }

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