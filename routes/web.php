<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {return view('welcome');});

// Módulo de Clientes
Route::post('/clientes', [ClienteController::class, 'store']);

// Módulo de Usuários (Cadastro)
Route::post('/usuarios', [UsuarioController::class, 'store']);

// Módulo de Autenticação (Login e Logout)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);