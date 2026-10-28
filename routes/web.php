<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TipologiaController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\ItemProjetoController;

Route::get('/', function () {return view('welcome');});

// Módulo de Clientes
Route::get('/clientes', [ClienteController::class, 'index']); // Mostra a tela
Route::post('/clientes', [ClienteController::class, 'store']); // Salva no banco
Route::get('/clientes/{id}', [ClienteController::class, 'show']); //Mostra lista de Cliente
Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit']); //Edita Cliente
Route::put('/clientes/{id}', [ClienteController::class, 'update']); //Atualiza a Edição
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']); //Exclui Cliente

// Módulo Endereço
Route::post('/clientes/{id}/enderecos', [EnderecoController::class, 'store']); //Guarda Endereço
Route::delete('/enderecos/{id}', [EnderecoController::class, 'destroy']);

// Módulo Contato
Route::post('/clientes/{id}/contatos', [ContatoController::class, 'store']); //Guarda um Contato
Route::delete('/contatos/{id}', [ContatoController::class, 'destroy']); // Exclui contato

// Módulo de Usuários (Cadastro)
Route::post('/usuarios', [UsuarioController::class, 'store']);

// Módulo de Autenticação (Login e Logout)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Módulo do Catálogo de Produtos (Tipologias - CRUD Completo)
Route::get('/tipologias', [TipologiaController::class, 'index']);
Route::post('/tipologias', [TipologiaController::class, 'store']);
Route::get('/tipologias/{id}', [TipologiaController::class, 'show']);
Route::put('/tipologias/{id}', [TipologiaController::class, 'update']);
Route::delete('/tipologias/{id}', [TipologiaController::class, 'destroy']);

// Módulo de Orçamentos (CRUD Completo)
Route::get('/orcamentos', [OrcamentoController::class, 'index']);
Route::post('/orcamentos', [OrcamentoController::class, 'store']);
Route::get('/orcamentos/{id}', [OrcamentoController::class, 'show']);
Route::put('/orcamentos/{id}', [OrcamentoController::class, 'update']);
Route::delete('/orcamentos/{id}', [OrcamentoController::class, 'destroy']);

// Módulo de Itens do Projeto (Vãos e Medidas - CRUD Completo)
Route::get('/itens-projeto', [ItemProjetoController::class, 'index']);
Route::post('/itens-projeto', [ItemProjetoController::class, 'store']);
Route::get('/itens-projeto/{id}', [ItemProjetoController::class, 'show']);
Route::put('/itens-projeto/{id}', [ItemProjetoController::class, 'update']);
Route::delete('/itens-projeto/{id}', [ItemProjetoController::class, 'destroy']);