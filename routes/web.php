<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TipologiaController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\ItemProjetoController;

// =========================================================================
// ROTAS PÚBLICAS (Descomentar telas GET na Fase 2)
// =========================================================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/usuarios/create', [UsuarioController::class, 'create']);
Route::post('/usuarios', [UsuarioController::class, 'store']);

// =========================================================================
// ROTAS DO SISTEMA (Envolver com middleware(['auth']) na Fase 2)
// =========================================================================
Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    // Módulo de Clientes
    Route::get('/clientes', [ClienteController::class, 'index']);
    Route::post('/clientes', [ClienteController::class, 'store']);
    Route::get('/clientes/{id}', [ClienteController::class, 'show']);
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit']);
    Route::put('/clientes/{id}', [ClienteController::class, 'update']);
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);

    // Módulo de Endereços (Obras)
    Route::post('/clientes/{id}/enderecos', [EnderecoController::class, 'store']);
    Route::delete('/enderecos/{id}', [EnderecoController::class, 'destroy']);

    // Módulo de Contatos
    Route::post('/clientes/{id}/contatos', [ContatoController::class, 'store']);
    Route::delete('/contatos/{id}', [ContatoController::class, 'destroy']);

    // Módulo de Materiais / Insumos (Correção do Route Model Binding em português)
    Route::resource('materiais', MaterialController::class)->parameters([
        'materiais' => 'material'
    ]);

    // Módulo de Tipologias (Descomentar rotas de tela e receita na Fase 4)
    Route::get('/tipologias', [TipologiaController::class, 'index']);
    // Route::get('/tipologias/create', [TipologiaController::class, 'create']);
    Route::post('/tipologias', [TipologiaController::class, 'store']);
    Route::get('/tipologias/{id}', [TipologiaController::class, 'show']);
    // Route::get('/tipologias/{id}/edit', [TipologiaController::class, 'edit']);
    Route::put('/tipologias/{id}', [TipologiaController::class, 'update']);
    Route::delete('/tipologias/{id}', [TipologiaController::class, 'destroy']);
    // Route::post('/tipologias/{id}/materiais', [TipologiaController::class, 'adicionarMaterial']);
    // Route::delete('/tipologias/{id}/materiais/{material}', [TipologiaController::class, 'removerMaterial']);

    // Módulo de Orçamentos (Descomentar rotas de tela na Fase 5)
    Route::get('/orcamentos', [OrcamentoController::class, 'index']);
    // Route::get('/orcamentos/create', [OrcamentoController::class, 'create']);
    Route::post('/orcamentos', [OrcamentoController::class, 'store']);
    Route::get('/orcamentos/{id}', [OrcamentoController::class, 'show']);
    // Route::get('/orcamentos/{id}/edit', [OrcamentoController::class, 'edit']);
    Route::put('/orcamentos/{id}', [OrcamentoController::class, 'update']);
    Route::delete('/orcamentos/{id}', [OrcamentoController::class, 'destroy']);

    // Módulo de Itens do Projeto (Vãos e Medidas)
    Route::get('/itens-projeto', [ItemProjetoController::class, 'index']);
    Route::post('/itens-projeto', [ItemProjetoController::class, 'store']);
    Route::get('/itens-projeto/{id}', [ItemProjetoController::class, 'show']);
    Route::put('/itens-projeto/{id}', [ItemProjetoController::class, 'update']);
    Route::delete('/itens-projeto/{id}', [ItemProjetoController::class, 'destroy']);

});