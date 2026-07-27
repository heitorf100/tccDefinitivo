<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemProjetoFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Mantemos aberto para os testes da mesma forma que os anteriores
    }

    public function rules(): array
    {
        return [
            'orcamento_id'     => ['required', 'exists:orcamentos,id'],
            'tipologia_id'     => ['required', 'exists:tipologias,id'],
            'ambiente_local'   => ['nullable', 'string', 'max:100'],
            
            // Medidas em Milímetros (Ex: min 10mm, max 20.000mm / 20 metros)
            'largura_vao'      => ['required', 'integer', 'min:10', 'max:20000'],
            'altura_vao'       => ['required', 'integer', 'min:10', 'max:20000'],
            'profundidade_vao' => ['nullable', 'integer', 'min:0', 'max:20000'],
            
            'quantidade'       => ['required', 'integer', 'min:1', 'max:9999'],
            
            // Valores financeiros continuam em Reais (com centavos)
            'valor_unitario'   => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'valor_subtotal'   => ['required', 'numeric', 'min:0', 'max:999999.99'],
            
            'observacao_item'  => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'orcamento_id.required' => 'O item precisa estar vinculado a um orçamento.',
            'orcamento_id.exists'   => 'O orçamento informado não existe.',
            'tipologia_id.required' => 'É obrigatório escolher um modelo de esquadria do catálogo.',
            'tipologia_id.exists'   => 'O modelo de esquadria selecionado não foi encontrado.',
            'largura_vao.required'  => 'A largura do vão é obrigatória.',
            'altura_vao.required'   => 'A altura do vão é obrigatória.',
            'quantidade.min'        => 'A quantidade mínima de peças deve ser 1.',
            'valor_unitario.required' => 'O valor unitário da esquadria é obrigatório.',
        ];
    }
}