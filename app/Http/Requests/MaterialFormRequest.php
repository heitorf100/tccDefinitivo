<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialFormRequest extends FormRequest
{
    /**
     * Determina se o utilizador está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true; // Permitido para todos os utilizadores autenticados
    }

    /**
     * Regras de validação que se aplicam à requisição.
     */
    public function rules(): array
    {
        // Recupera o ID caso seja uma atualização, para evitar erro de código duplicado
        $materialId = $this->route('material') ? $this->route('material')->id : null;

        return [
            'codigo'         => ['required', 'string', 'max:50', 'unique:materiais,codigo,' . $materialId],
            'descricao'      => ['required', 'string', 'max:150'],
            'cor'            => ['nullable', 'string', 'max:50'],
            'tipo'           => ['required', 'in:Perfil,Acessório,Vidro,Diversos'],
            'unidade_medida' => ['required', 'in:Barra,Metro,M2,Unidade'],
            'tamanho_padrao_mm' => ['nullable', 'integer', 'min:0'],
            'peso_por_metro' => ['nullable', 'numeric', 'min:0'],
            'preco_custo'    => ['required', 'numeric', 'min:0'],
            'imagem' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    /**
     * Mensagens de erro personalizadas.
     */
    public function messages(): array
    {
        return [
            'codigo.required'    => 'O código do material é obrigatório.',
            'codigo.unique'      => 'Este código já se encontra registado no sistema.',
            'descricao.required' => 'A descrição do material é obrigatória.',
            'tipo.in'            => 'Selecione um tipo de material válido.',
            'unidade_medida.in'  => 'Selecione uma unidade de medida válida.',
            'preco_custo.numeric'=> 'O preço de custo deve ser um valor numérico válido.',
            'imagem.max' => 'A imagem não pode ultrapassar 2MB.',
        ];
    }
}