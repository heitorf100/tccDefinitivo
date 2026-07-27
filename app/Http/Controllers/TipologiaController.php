<?php

namespace App\Http\Controllers;

use App\Models\Tipologia;
use App\Http\Requests\TipologiaFormRequest;
use Illuminate\Http\Request;

class TipologiaController extends Controller
{
    /**
     * LISTAR: Retorna todo o catálogo de produtos (útil para a tela de Orçamentos)
     */
    public function index()
    {
        $tipologias = Tipologia::all();
        return response()->json($tipologias, 200);
    }

    /**
     * CRIAR: Salva um novo modelo de esquadria no banco de dados
     */
    public function store(TipologiaFormRequest $request)
    {
        // O $request->validated() só passa para cá se as regras do FormRequest forem cumpridas
        $tipologia = Tipologia::create($request->validated());

        return response()->json([
            'status'  => 'sucesso',
            'message' => 'Novo modelo adicionado ao catálogo!',
            'dados'   => $tipologia
        ], 201);
    }

    /**
     * LER UM: Mostra os detalhes de um modelo específico
     */
    public function show($id)
    {
        $tipologia = Tipologia::find($id);

        if (!$tipologia) {
            return response()->json(['message' => 'Modelo não encontrado.'], 404);
        }

        return response()->json($tipologia, 200);
    }

    /**
     * ATUALIZAR: Edita os dados de um modelo existente
     */
    public function update(TipologiaFormRequest $request, $id)
    {
        $tipologia = Tipologia::find($id);

        if (!$tipologia) {
            return response()->json(['message' => 'Modelo não encontrado.'], 404);
        }

        $tipologia->update($request->validated());

        return response()->json([
            'status'  => 'sucesso',
            'message' => 'Catálogo atualizado com sucesso!',
            'dados'   => $tipologia
        ], 200);
    }

    /**
     * EXCLUIR: Tenta deletar um modelo do catálogo
     */
    public function destroy($id)
    {
        $tipologia = Tipologia::find($id);

        if (!$tipologia) {
            return response()->json(['message' => 'Modelo não encontrado.'], 404);
        }

        try {
            $tipologia->delete();
            return response()->json(['message' => 'Modelo excluído do catálogo com sucesso!'], 200);
        } catch (\Exception $e) {
            // A mágica da trava que criamos na Migration (onDelete restrict) age aqui.
            // Se o banco barrar a exclusão, capturamos o erro e avisamos o usuário com elegância.
            return response()->json([
                'status'  => 'erro',
                'message' => 'Não é possível excluir este modelo, pois ele já faz parte de um ou mais orçamentos cadastrados.'
            ], 400);
        }
    }
}