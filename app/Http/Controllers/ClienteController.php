<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Armazena um novo cliente no banco de dados.
     * 
     * @param ClienteFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ClienteFormRequest $request)
    {
        // Como estamos usando o ClienteFormRequest, se chegou até aqui,
        // os dados já passaram por todas as validações de segurança e regras.
        
        $cliente = Cliente::create($request->validated());

        // Retorno de resposta estruturado para API / requisições
        return response()->json([
            'status' => 'sucesso',
            'message' => 'Cliente cadastrado com sucesso!',
            'data' => $cliente
        ], 201);
    }
}