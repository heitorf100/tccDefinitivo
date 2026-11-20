@extends('layouts.app')

@section('conteudo')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i>Editar Material</h3>
            <a href="{{ route('materiais.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Voltar ao Catálogo
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('materiais.update', $material) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="codigo" class="form-label fw-bold">Código <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('codigo') is-invalid @enderror"
                                   id="codigo" name="codigo" value="{{ old('codigo', $material->codigo) }}" required>
                            @error('codigo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-8">
                            <label for="descricao" class="form-label fw-bold">Descrição <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('descricao') is-invalid @enderror"
                                   id="descricao" name="descricao" value="{{ old('descricao', $material->descricao) }}" required>
                            @error('descricao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="tipo" class="form-label fw-bold">Tipo <span class="text-danger">*</span></label>
                            @php $tipoAtual = old('tipo', $material->tipo); @endphp
                            <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                                <option value="Perfil" {{ $tipoAtual == 'Perfil' ? 'selected' : '' }}>Perfil</option>
                                <option value="Vidro" {{ $tipoAtual == 'Vidro' ? 'selected' : '' }}>Vidro</option>
                                <option value="Acessório" {{ $tipoAtual == 'Acessório' ? 'selected' : '' }}>Acessório</option>
                                <option value="Vedação" {{ $tipoAtual == 'Vedação' ? 'selected' : '' }}>Vedação</option>
                            </select>
                            @error('tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cor" class="form-label fw-bold">Cor / Acabamento</label>
                            <input type="text" class="form-control @error('cor') is-invalid @enderror"
                                   id="cor" name="cor" value="{{ old('cor', $material->cor) }}">
                            @error('cor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="unidade_medida" class="form-label fw-bold">Unidade de Medida <span class="text-danger">*</span></label>
                            @php $unidadeAtual = old('unidade_medida', $material->unidade_medida); @endphp
                            <select class="form-select @error('unidade_medida') is-invalid @enderror" id="unidade_medida" name="unidade_medida" required>
                                <option value="Barra" {{ $unidadeAtual == 'Barra' ? 'selected' : '' }}>Barra</option>
                                <option value="Metro" {{ $unidadeAtual == 'Metro' ? 'selected' : '' }}>Metro</option>
                                <option value="m²" {{ $unidadeAtual == 'm²' ? 'selected' : '' }}>m²</option>
                                <option value="Unidade" {{ $unidadeAtual == 'Unidade' ? 'selected' : '' }}>Unidade</option>
                                <option value="Kit" {{ $unidadeAtual == 'Kit' ? 'selected' : '' }}>Kit</option>
                            </select>
                            @error('unidade_medida')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="tamanho_padrao_mm" class="form-label fw-bold">Tamanho Padrão (mm)</label>
                            <input type="number" class="form-control @error('tamanho_padrao_mm') is-invalid @enderror"
                                   id="tamanho_padrao_mm" name="tamanho_padrao_mm"
                                   value="{{ old('tamanho_padrao_mm', $material->tamanho_padrao_mm) }}">
                            @error('tamanho_padrao_mm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="peso_por_metro" class="form-label fw-bold">Peso por Metro (kg/m)</label>
                            <input type="number" step="0.001" class="form-control @error('peso_por_metro') is-invalid @enderror"
                                   id="peso_por_metro" name="peso_por_metro"
                                   value="{{ old('peso_por_metro', $material->peso_por_metro) }}">
                            @error('peso_por_metro')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="preco_custo" class="form-label fw-bold">Preço de Custo (R$) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('preco_custo') is-invalid @enderror"
                                   id="preco_custo" name="preco_custo"
                                   value="{{ old('preco_custo', $material->preco_custo) }}" required>
                            @error('preco_custo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="imagem" class="form-label fw-bold">Alterar Imagem / Perfil Técnico</label>
                        @if($material->imagem)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $material->imagem) }}" alt="Imagem atual"
                                     class="rounded border" style="height: 80px; object-fit: cover;">
                                <small class="text-muted d-block">Imagem atual (envie outra apenas se quiser substituir)</small>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('imagem') is-invalid @enderror"
                               id="imagem" name="imagem" accept="image/*">
                        @error('imagem')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('materiais.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="bi bi-save me-1"></i> Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('unidade_medida').addEventListener('change', function () {
        const campoTamanho = document.getElementById('tamanho_padrao_mm');
        if (this.value === 'Barra' && !campoTamanho.value) {
            campoTamanho.value = 6000;
        }
    });
</script>
@endpush