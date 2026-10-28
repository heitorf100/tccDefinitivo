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
     * EXIBIR PERFIL: Mostra os detalhes do cliente, endereços e contatos
     */
    public function show($id)
    {
        // Busca o cliente pelo ID ou retorna erro 404, carregando os relacionamentos 3FN
        $cliente = Cliente::with(['enderecos', 'contatos'])->findOrFail($id);

        return view('clientes.show', compact('cliente'));
    }

    /**
     * EDITAR: Abre o formulário de edição de cliente
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * ATUALIZAR: Salva as alterações do cliente no banco de dados
     */
    public function update(ClienteFormRequest $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->validated());

        return redirect()->to('/clientes')->with('sucesso', 'Cliente atualizado com sucesso!');
    }

    /**
     * EXCLUIR: Remove o cliente da base de dados (o onDelete cascade limpa endereços e contatos)
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->to('/clientes')->with('sucesso', 'Cliente excluído com sucesso!');
    }

    /**
     * Armazena um novo cliente no banco de dados.
     */
    public function store(ClienteFormRequest $request)
    {
        // Valida e guarda na base de dados
        Cliente::create($request->validated());

        // Redireciona com segurança para a lista preservando o túnel do Codespaces
        return redirect()->to('/clientes')->with('sucesso', 'Cliente cadastrado com sucesso!');
    }
}