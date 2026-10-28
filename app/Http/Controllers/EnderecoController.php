<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnderecoFormRequest;
use App\Models\Endereco;

class EnderecoController extends Controller
{
    public function store(EnderecoFormRequest $request, $clienteId)
    {
        $dados = $request->validated();
        $dados['cliente_id'] = $clienteId;

        Endereco::create($dados);

        // Alterado para redirect()->to para blindar o redirecionamento no Codespaces
        return redirect()->to("/clientes/{$clienteId}")->with('sucesso', 'Endereço cadastrado com sucesso!');
    }

    public function destroy($id)
    {
        $endereco = Endereco::findOrFail($id);
        $endereco->delete();

        // Usar o back()->with garante que ele retorna exatamente para a página de onde veio, mantendo o túnel do Codespaces estável
        return back()->with('sucesso', 'Endereço excluído com sucesso!');
    }
}