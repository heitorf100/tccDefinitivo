<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoFormRequest extends FormRequest
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
            'logradouro'    => ['required', 'string', 'max:150'],
            'numero'        => ['required', 'string', 'max:10'],
            'bairro'        => ['required', 'string', 'max:100'],
            'cidade'        => ['required', 'string', 'max:100'],
            
            // 'alpha' garante que sejam apenas letras (bloqueia números como "11" no lugar da UF)
            'estado'        => ['required', 'string', 'size:2', 'alpha'], 
            
            // 'regex' valida o formato padrão de CEP brasileiro (ex: 87501-000 ou 87501000)
            'cep'           => ['required', 'string', 'regex:/^\d{5}-?\d{3}$/'], 
            
            'tipo_endereco' => ['required', 'in:Residencial,Comercial,Obra'],
        ];
    }

    /**
     * Mensagens de erro personalizadas em Português para uma melhor UX.
     */
    public function messages(): array
    {
        return [
            'estado.alpha' => 'O campo Estado deve conter apenas letras (sigla da UF).',
            'estado.size'  => 'O campo Estado deve ter exatamente 2 caracteres (ex: PR).',
            'cep.regex'    => 'O formato do CEP é inválido. Utilize o formato 00000-000 ou apenas números.',
            'tipo_endereco.in' => 'O tipo de endereço selecionado é inválido.',
        ];
    }
}