@extends('layouts.app')

@section('conteudo')
<div class="text-center mb-5">
    <h1 class="fw-bold">Painel de Controle</h1>
    <p class="text-muted">Visão geral do Sistema de Gestão e Controle de Corte de Alumínio</p>
</div>

<div class="row g-4">
    <!-- Card Orçamentos -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <i class="bi bi-file-earmark-text text-primary mb-3" style="font-size: 3rem;"></i>
                    <h4 class="fw-bold">Orçamentos</h4>
                    <p class="text-muted small">Crie novos orçamentos, adicione medidas de vãos e gere os contratos.</p>
                </div>
                <a href="/orcamentos" class="btn btn-primary fw-bold w-100 mt-3">Acessar Módulo</a>
            </div>
        </div>
    </div>

    <!-- Card Catálogo (Tipologias + Materiais) -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <i class="bi bi-grid text-success mb-3" style="font-size: 3rem;"></i>
                    <h4 class="fw-bold">Catálogo</h4>
                    <p class="text-muted small">Cadastre tipologias, portas, janelas e gerencie os insumos da fábrica.</p>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <a href="/tipologias" class="btn btn-success fw-bold w-50">Tipologias</a>
                    <a href="/materiais" class="btn btn-outline-success fw-bold w-50">Materiais</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Clientes -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <i class="bi bi-people text-warning mb-3" style="font-size: 3rem;"></i>
                    <h4 class="fw-bold">Clientes</h4>
                    <p class="text-muted small">Consulte a base de clientes, contatos e gerencie os endereços de obras.</p>
                </div>
                <a href="/clientes" class="btn btn-warning fw-bold w-100 mt-3">Carteira de Clientes</a>
            </div>
        </div>
    </div>
</div>
@endsection