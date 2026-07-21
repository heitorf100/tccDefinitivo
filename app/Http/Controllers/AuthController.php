<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tenta autenticar o usuário no sistema.
     */
    public function login(Request $request)
    {
        // 1. Validação rápida para garantir que os campos foram preenchidos
        $credenciais = $request->validate([
            'login_email' => ['required', 'email'],
            'senha'       => ['required'],
        ]);

        // 2. Tentativa de Login
        // O Laravel exige que a chave da senha passada para o Auth::attempt() se chame 'password'.
        // O método getAuthPassword() que criamos no Model avisa que, no banco, isso é o 'senha_hash'.
        if (Auth::attempt(['login_email' => $credenciais['login_email'], 'password' => $credenciais['senha']])) {
            
            // Segurança: Regenera a sessão para evitar ataques de fixação de sessão (Session Fixation)
            $request->session()->regenerate();

            // Captura os dados do usuário que acabou de logar
            $usuarioLogado = Auth::user();

            return response()->json([
                'status'  => 'sucesso',
                'message' => 'Login realizado com sucesso!',
                'usuario' => $usuarioLogado
            ], 200);
        }

        // 3. Se a senha ou o e-mail estiverem errados, barra o acesso (Erro 401: Unauthorized)
        return response()->json([
            'status'  => 'erro',
            'message' => 'E-mail ou senha incorretos.'
        ], 401);
    }

    /**
     * Desloga o usuário e destrói a sessão.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        // Invalida a sessão atual e gera um novo token de segurança CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'status'  => 'sucesso',
            'message' => 'Sessão encerrada com sucesso!'
        ], 200);
    }
}