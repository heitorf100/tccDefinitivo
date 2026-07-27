<?php

namespace App\Http\Controllers;

use App\Models\ItemProjeto;
use App\Http\Requests\ItemProjetoFormRequest;
use Illuminate\Http\Request;

class ItemProjetoController extends Controller
{
    /**
     * LISTAR: Retorna todos os itens cadastrados no sistema (com suas tipologias)
     */
    public function index()
    {
        $itens = ItemProjeto::with(['tipologia', 'orcamento'])->get();
        return response()->json($itens, 200);
    }

    /**
     * CRIAR: Adiciona um novo vão/item a um orçamento existente
     */
    public function store(ItemProjetoFormRequest $request)
    {
        $item = ItemProjeto::create($request->validated());

        return response()->json([
            'status'  => 'sucesso',
            'message' => 'Item adicionado ao orçamento com sucesso!',
            'dados'   => $item
        ], 201);
    }

    /**
     * LER UM: Mostra os detalhes de um item específico
     */
    public function show($id)
    {
        $item = ItemProjeto::with(['tipologia', 'orcamento'])->find($id);

        if (!$item) {
            return response()->json(['message' => 'Item de projeto não encontrado.'], 404);
        }

        return response()->json($item, 200);
    }

    /**
     * ATUALIZAR: Modifica medidas, quantidades ou valores de um item já lançado
     */
    public function update(ItemProjetoFormRequest $request, $id)
    {
        $item = ItemProjeto::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item de projeto não encontrado.'], 404);
        }

        $item->update($request->validated());

        return response()->json([
            'status'  => 'sucesso',
            'message' => 'Item atualizado com sucesso!',
            'dados'   => $item
        ], 200);
    }

    /**
     * EXCLUIR: Remove um vão/item do orçamento
     */
    public function destroy($id)
    {
        $item = ItemProjeto::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item de projeto não encontrado.'], 404);
        }

        $item->delete();

        return response()->json([
            'status'  => 'sucesso',
            'message' => 'Item removido do orçamento com sucesso!'
        ], 200);
    }
}