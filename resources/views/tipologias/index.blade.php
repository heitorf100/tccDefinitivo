@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-window me-2"></i>Catálogo de Tipologias</h2>
        <p class="text-muted mb-0">Modelos de portas, janelas, portões e suas receitas de corte</p>
    </div>
    <a href="/tipologias/create" class="btn btn-success fw-bold">
        <i class="bi bi-plus-circle me-1"></i> Nova Tipologia
    </a>
</div>

@if(session('sucesso'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('sucesso') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('erro'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('erro') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 70px;" class="text-center">Croqui</th>
                        <th>Código Ref.</th>
                        <th>Nome do Modelo</th>
                        <th>Descrição</th>
                        <th class="text-center">Receita (Insumos)</th>
                        <th class="text-end" style="width: 180px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tipologias as $tipologia)
                        <tr>
                            <td class="text-center">
                                @if($tipologia->imagem_url)
                                    <img src="{{ asset('storage/' . $tipologia->imagem_url) }}"
                                         alt="{{ $tipologia->codigo_ref }}"
                                         class="rounded border"
                                         style="width: 48px; height: 48px; object-fit: cover;">
                                @else
                                    <div class="bg-light border rounded d-inline-flex align-items-center justify-content-center text-muted"
                                         style="width: 48px; height: 48px;">
                                        <i class="bi bi-window"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $tipologia->codigo_ref }}</td>
                            <td class="fw-semibold">{{ $tipologia->nome }}</td>
                            <td class="text-muted">{{ \Illuminate\Support\Str::limit($tipologia->descricao, 60) ?? '-' }}</td>
                            <td class="text-center">
                                @if($tipologia->materiais_count > 0)
                                    <span class="badge bg-primary">{{ $tipologia->materiais_count }} {{ $tipologia->materiais_count == 1 ? 'item' : 'itens' }}</span>
                                @else
                                    <span class="badge bg-warning text-dark">Sem receita</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="/tipologias/{{ $tipologia->id }}" class="btn btn-sm btn-outline-info" title="Receita de Corte / Detalhes">
                                    <i class="bi bi-list-check"></i>
                                </a>
                                <a href="/tipologias/{{ $tipologia->id }}/edit" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="/tipologias/{{ $tipologia->id }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Tem certeza que deseja excluir esta tipologia?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Nenhuma tipologia cadastrada até o momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection