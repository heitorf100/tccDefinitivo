<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * LISTAR: Retorna a tela visual com a tabela de clientes
     */
    public function index()
    {
        // Busca todos os clientes no banco de dados
        $clientes = Cliente::all();
        
        // Devolve a tela 'clientes.index' passando a variável $clientes para ela
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Armazena um novo cliente no banco de dados.
     * 
     * @param ClienteFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ClienteFormRequest $request)
    {
        // Valida e guarda na base de dados
        $cliente = Cliente::create($request->validated());

        // Em vez de retornar JSON, redirecionamos de volta para a lista com uma mensagem
        return redirect('/clientes')->with('sucesso', 'Cliente cadastrado com sucesso!');
    }
}