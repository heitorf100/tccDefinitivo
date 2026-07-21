<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioFormRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Armazena um novo usuário no banco de dados.
     * 
     * @param UsuarioFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UsuarioFormRequest $request)
    {
        // 1. Pegamos apenas os dados que passaram pelas suas regras rigorosas de validação
        $dadosValidados = $request->validated();

        // 2. Criamos o usuário mapeando os campos e aplicando a criptografia
        $usuario = Usuario::create([
            'nome'         => $dadosValidados['nome'],
            'login_email'  => $dadosValidados['login_email'],
            
            // Aqui acontece a mágica: pegamos a 'senha' limpa e transformamos em um Hash seguro
            // salvando diretamente na coluna 'senha_hash' do banco de dados.
            'senha_hash'   => Hash::make($dadosValidados['senha']),
            
            'cargo'        => $dadosValidados['cargo'],
            'status_ativo' => $dadosValidados['status_ativo'] ?? true,
        ]);

        // 3. Retornamos a confirmação para quem fez a requisição (frontend/API)
        return response()->json([
            'status' => 'sucesso',
            'message' => 'Usuário cadastrado com sucesso!',
            'data' => $usuario
        ], 201);
    }
}