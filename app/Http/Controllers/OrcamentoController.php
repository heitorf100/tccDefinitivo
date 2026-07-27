<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Http\Requests\OrcamentoFormRequest;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    /**
     * LISTAR: Retorna todos os orçamentos cadastrados, trazendo junto os dados do cliente e da obra
     */
    public function index()
    {
        // O with() puxa os relacionamentos que definimos no Model (Eager Loading)
        $orcamentos = Orcamento::with(['cliente', 'endereco', 'itens'])->get();
        return response()->json($orcamentos, 200);
    }

    /**
     * CRIAR: Salva um novo orçamento no banco de dados
     */
    public function store(OrcamentoFormRequest $request)
    {
        $orcamento = Orcamento::create($request->validated());

        return response()->json([
            'status'  => 'sucesso',
            'message' => 'Orçamento gerado com sucesso!',
            'dados'   => $orcamento
        ], 201);
    }

    /**
     * LER UM: Mostra os detalhes de um orçamento específico com seus itens e cliente
     */
    public function show($id)
    {
        $orcamento = Orcamento::with(['cliente', 'endereco', 'itens.tipologia'])->find($id);

        if (!$orcamento) {
            return response()->json(['message' => 'Orçamento não encontrado.'], 404);
        }

        return response()->json($orcamento, 200);
    }

    /**
     * ATUALIZAR: Modifica os dados ou o status de um orçamento existente
     */
    public function update(OrcamentoFormRequest $request, $id)
    {
        $orcamento = Orcamento::find($id);

        if (!$orcamento) {
            return response()->json(['message' => 'Orçamento não encontrado.'], 404);
        }

        $orcamento->update($request->validated());

        return response()->json([
            'status'  => 'sucesso',
            'message' => 'Orçamento atualizado com sucesso!',
            'dados'   => $orcamento
        ], 200);
    }

    /**
     * EXCLUIR: Remove um orçamento (os itens atrelados a ele caem em cascata)
     */
    public function destroy($id)
    {
        $orcamento = Orcamento::find($id);

        if (!$orcamento) {
            return response()->json(['message' => 'Orçamento não encontrado.'], 404);
        }

        $orcamento->delete();

        return response()->json([
            'status'  => 'sucesso',
            'message' => 'Orçamento excluído com sucesso!'
        ], 200);
    }
}