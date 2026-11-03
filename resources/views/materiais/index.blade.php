@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-box-seam me-2"></i>Catálogo de Materiais (Insumos)</h2>
    <a href="/materiais/create" class="btn btn-warning fw-bold shadow-sm">
        <i class="bi bi-plus-lg"></i> Novo Material
    </a>
</div>

<!-- Alerta de Sucesso -->
@if(session('sucesso'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('sucesso') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4">Código</th>
                        <th>Descrição</th>
                        <th>Tipo</th>
                        <th>Cor/Acabamento</th>
                        <th>Medida</th>
                        <th>Custo (R$)</th>
                        <th class="text-center pe-4">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materiais as $material)
                        <tr>
                            <td class="ps-4 fw-bold text-secondary">{{ $material->codigo }}</td>
                            <td>{{ $material->descricao }}</td>
                            <td>
                                <!-- Badges coloridas dependendo do tipo para facilitar a visualização -->
                                @if($material->tipo == 'Perfil')
                                    <span class="badge bg-primary">Perfil</span>
                                @elseif($material->tipo == 'Vidro')
                                    <span class="badge bg-info text-dark">Vidro</span>
                                @elseif($material->tipo == 'Acessório')
                                    <span class="badge bg-warning text-dark">Acessório</span>
                                @else
                                    <span class="badge bg-secondary">Diversos</span>
                                @endif
                            </td>
                            <td>{{ $material->cor ?? '-' }}</td>
                            <td>
                                {{ $material->unidade_medida }}
                                @if($material->tamanho_padrao_mm)
                                    <small class="text-muted d-block">{{ $material->tamanho_padrao_mm }} mm</small>
                                @endif
                            </td>
                            <td>R$ {{ number_format($material->preco_custo, 2, ',', '.') }}</td>
                            <td class="text-center pe-4">
                                <div class="btn-group" role="group">
                                    <a href="/materiais/{{ $material->id }}/edit" class="btn btn-sm btn-outline-primary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <!-- Formulário para exclusão segura -->
                                    <form action="/materiais/{{ $material->id }}" method="POST" class="d-inline" onsubmit="return confirm('Tem a certeza que deseja excluir este material? Esta ação não pode ser desfeita.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                Nenhum material cadastrado no catálogo ainda.<br>
                                Clique em <strong>"Novo Material"</strong> para começar a alimentar o seu stock.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection