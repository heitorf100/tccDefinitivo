@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-box-seam me-2"></i>Catálogo de Materiais</h2>
        <p class="text-muted mb-0">Perfis de alumínio, vidros, acessórios e vedações</p>
    </div>
    <a href="{{ route('materiais.create') }}" class="btn btn-success fw-bold">
        <i class="bi bi-plus-circle me-1"></i> Novo Material
    </a>
</div>

@if(session('sucesso'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('sucesso') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 70px;" class="text-center">Foto</th>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>Tipo</th>
                        <th>Cor</th>
                        <th>Unidade / Barra</th>
                        <th>Preço Custo</th>
                        <th class="text-end" style="width: 160px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materiais as $material)
                        <tr>
                            <td class="text-center">
                                @if($material->imagem)
                                    <img src="{{ asset('storage/' . $material->imagem) }}"
                                         alt="{{ $material->codigo }}"
                                         class="rounded border"
                                         style="width: 48px; height: 48px; object-fit: cover;">
                                @else
                                    <div class="bg-light border rounded d-inline-flex align-items-center justify-content-center text-muted"
                                         style="width: 48px; height: 48px;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $material->codigo }}</td>
                            <td>{{ $material->descricao }}</td>
                            <td><span class="badge bg-secondary">{{ $material->tipo }}</span></td>
                            <td>{{ $material->cor ?? '-' }}</td>
                            <td>
                                {{ $material->unidade_medida }}
                                @if($material->tamanho_padrao_mm)
                                    <small class="text-muted d-block">{{ $material->tamanho_padrao_mm }} mm</small>
                                @endif
                            </td>
                            <td class="fw-bold text-success">
                                R$ {{ number_format($material->preco_custo, 2, ',', '.') }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('materiais.show', $material) }}" class="btn btn-sm btn-outline-info" title="Detalhes">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('materiais.edit', $material) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('materiais.destroy', $material) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Tem certeza que deseja excluir este material?');">
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
                            <td colspan="8" class="text-center py-4 text-muted">
                                Nenhum material cadastrado até o momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection