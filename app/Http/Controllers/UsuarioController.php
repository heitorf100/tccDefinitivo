<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioFormRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function create()
    {
        return view('usuarios.create');
    }

    public function store(UsuarioFormRequest $request)
    {
        $dadosValidados = $request->validated();

        Usuario::create([
            'nome'         => $dadosValidados['nome'],
            'login_email'  => $dadosValidados['login_email'],
            'senha_hash'   => Hash::make($dadosValidados['senha']),
            'cargo'        => $dadosValidados['cargo'],
            'status_ativo' => $dadosValidados['status_ativo'] ?? true,
        ]);

        return redirect('/login')->with('sucesso', 'Usuário cadastrado com sucesso! Faça login para continuar.');
    }
}