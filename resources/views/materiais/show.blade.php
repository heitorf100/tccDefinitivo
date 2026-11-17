@extends('layouts.app')

@section('conteudo')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold mb-0"><i class="bi bi-file-earmark-ruled me-2"></i>Ficha Técnica do Material</h3>
            <a href="{{ route('materiais.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Voltar
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="row g-4 align-items-center">
                    <div class="col-md-4 text-center">
                        @if($material->imagem)
                            <img src="{{ asset('storage/' . $material->imagem) }}"
                                 alt="{{ $material->codigo }}"
                                 class="img-fluid rounded border shadow-sm"
                                 style="max-height: 240px; object-fit: contain;">
                        @else
                            <div class="bg-light border rounded d-flex flex-column align-items-center justify-content-center text-muted p-4"
                                 style="height: 220px;">
                                <i class="bi bi-image" style="font-size: 3rem;"></i>
                                <small class="mt-2">Sem imagem cadastrada</small>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-8">
                        <span class="badge bg-dark mb-2">{{ $material->tipo }}</span>
                        <h4 class="fw-bold mb-1">{{ $material->codigo }} — {{ $material->descricao }}</h4>
                        <p class="text-muted mb-3">Cor / Acabamento: <strong>{{ $material->cor ?? 'Não especificado' }}</strong></p>

                        <table class="table table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <th class="bg-light w-50">Unidade de Medida</th>
                                    <td>{{ $material->unidade_medida }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Tamanho Padrão (Barra)</th>
                                    <td>{{ $material->tamanho_padrao_mm ? $material->tamanho_padrao_mm . ' mm' : 'Não aplicável' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Peso Linear</th>
                                    <td>{{ $material->peso_por_metro ? number_format($material->peso_por_metro, 3, ',', '.') . ' kg/m' : 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Preço de Custo</th>
                                    <td class="fw-bold text-success">R$ {{ number_format($material->preco_custo, 2, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('materiais.edit', $material) }}" class="btn btn-primary">
                                <i class="bi bi-pencil me-1"></i> Editar Material
                            </a>
                            <form action="{{ route('materiais.destroy', $material) }}" method="POST"
                                  onsubmit="return confirm('Deseja realmente excluir este material?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="bi bi-trash me-1"></i> Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection