<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'login_email' => ['required', 'email'],
            'senha'       => ['required'],
        ], [
            'login_email.required' => 'Informe o seu e-mail.',
            'login_email.email'    => 'Informe um e-mail válido.',
            'senha.required'       => 'Informe a sua senha.',
        ]);

        if (Auth::attempt([
            'login_email'  => $credenciais['login_email'],
            'password'     => $credenciais['senha'],
            'status_ativo' => true,
        ])) {
            $request->session()->regenerate();

            return redirect()->intended('/')->with('sucesso', 'Login realizado com sucesso!');
        }

        return back()->withErrors([
            'login_email' => 'E-mail ou senha incorretos, ou usuário inativo.',
        ])->onlyInput('login_email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('sucesso', 'Sessão encerrada com sucesso!');
    }
}