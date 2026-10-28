<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoFormRequest;
use App\Models\Contato;

class ContatoController extends Controller
{
    public function store(ContatoFormRequest $request, $clienteId)
    {
        $dados = $request->validated();
        $dados['cliente_id'] = $clienteId;

        Contato::create($dados);

        return back()->with('sucesso', 'Contato cadastrado com sucesso!');
    }

    public function destroy($id)
    {
        $contato = Contato::findOrFail($id);
        $contato->delete();

        return back()->with('sucesso', 'Contato excluído com sucesso!');
    }
}