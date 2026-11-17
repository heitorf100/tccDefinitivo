<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrcamentoFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_id'  => ['required', 'exists:clientes,id'],
            'endereco_id' => [
                'required',
                Rule::exists('enderecos', 'id')->where(function ($query) {
                    return $query->where('cliente_id', $this->input('cliente_id'));
                }),
            ],
            'data_criacao'            => ['required', 'date'],
            'data_validade'           => ['nullable', 'date', 'after_or_equal:data_criacao'],
            'prazo_entrega_dias'      => ['nullable', 'integer', 'min:1'],
            'tipo_servico'            => ['required', 'in:APENAS_PRODUCAO,PRODUCAO_E_INSTALACAO'],
            'condicoes_pagamento'     => ['nullable', 'string', 'max:255'],
            'garantia_meses'          => ['required', 'integer', 'min:0'],
            'observacoes_contratuais' => ['nullable', 'string'],
            'status_pedido'           => ['sometimes', 'in:ORCAMENTO,APROVADO,PRODUCAO,FINALIZADO,CANCELADO'],
            'valor_total'             => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'cliente_id.required'          => 'É obrigatório selecionar um cliente para o orçamento.',
            'cliente_id.exists'            => 'O cliente selecionado não foi encontrado no banco de dados.',
            'endereco_id.required'         => 'É obrigatório selecionar o endereço ou local da obra.',
            'endereco_id.exists'           => 'O endereço selecionado não pertence a este cliente ou não foi encontrado.',
            'data_criacao.required'        => 'A data de criação do orçamento é obrigatória.',
            'data_validade.after_or_equal' => 'A data de validade deve ser igual ou posterior à data de criação.',
            'tipo_servico.in'              => 'O tipo de serviço escolhido é inválido.',
        ];
    }
}