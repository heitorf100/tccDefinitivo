<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrcamentoFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Mantemos aberto por enquanto, seguindo a mesma estratégia das tipologias
    }

    public function rules(): array
    {
        return [
            'cliente_id'              => ['required', 'exists:clientes,id'],
            'endereco_id'             => ['required', 'exists:enderecos,id'],
            'data_criacao'            => ['required', 'date'],
            'data_validade'           => ['nullable', 'date'],
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
            'cliente_id.required'  => 'É obrigatório selecionar um cliente para o orçamento.',
            'cliente_id.exists'    => 'O cliente selecionado não foi encontrado no banco de dados.',
            'endereco_id.required' => 'É obrigatório selecionar o endereço ou local da obra.',
            'endereco_id.exists'   => 'O endereço selecionado não foi encontrado.',
            'data_criacao.required'=> 'A data de criação do orçamento é obrigatória.',
            'tipo_servico.in'      => 'O tipo de serviço escolhido é inválido.',
        ];
    }
}