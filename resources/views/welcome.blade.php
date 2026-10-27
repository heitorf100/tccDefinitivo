@extends('layouts.app')

@section('conteudo')
<!-- Cabeçalho de Boas-vindas -->
<div class="row mb-5 mt-3">
    <div class="col-12 text-center">
        <h1 class="display-5 fw-bold text-dark">Painel de Controle</h1>
        <p class="lead text-muted">Visão geral do Sistema de Gestão e Controle de Corte de Alumínio</p>
    </div>
</div>

<!-- Grid de Atalhos (Cards) -->
<div class="row g-4">
    <!-- Card de Orçamentos -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 rounded-4 transition-hover">
            <div class="card-body text-center p-4">
                <div class="text-primary mb-3">
                    <i class="bi bi-file-earmark-text" style="font-size: 3.5rem;"></i>
                </div>
                <h4 class="card-title fw-bold">Orçamentos</h4>
                <p class="card-text text-muted mb-4">Crie novos orçamentos, adicione medidas de vãos e gere os contratos.</p>
                <a href="/orcamentos" class="btn btn-primary w-100 rounded-pill fw-semibold">Acessar Módulo</a>
            </div>
        </div>
    </div>

    <!-- Card do Catálogo -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 rounded-4 transition-hover">
            <div class="card-body text-center p-4">
                <div class="text-success mb-3">
                    <i class="bi bi-grid" style="font-size: 3.5rem;"></i>
                </div>
                <h4 class="card-title fw-bold">Catálogo</h4>
                <p class="card-text text-muted mb-4">Cadastre tipologias, portas, janelas e gerencie os modelos da fábrica.</p>
                <a href="/tipologias" class="btn btn-success w-100 rounded-pill fw-semibold">Gerenciar Esquadrias</a>
            </div>
        </div>
    </div>

    <!-- Card de Clientes -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 rounded-4 transition-hover">
            <div class="card-body text-center p-4">
                <div class="text-warning mb-3">
                    <i class="bi bi-people" style="font-size: 3.5rem;"></i>
                </div>
                <h4 class="card-title fw-bold">Clientes</h4>
                <p class="card-text text-muted mb-4">Consulte a base de clientes, contatos e gerencie os endereços de obras.</p>
                <a href="/clientes" class="btn btn-warning w-100 rounded-pill fw-semibold text-dark">Carteira de Clientes</a>
            </div>
        </div>
    </div>
</div>

<!-- Estilo extra apenas para dar um efeito suave ao passar o mouse -->
<style>
    .transition-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>
@endsection