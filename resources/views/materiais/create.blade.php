@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="bi bi-plus-circle me-2"></i>Novo Material</h2>
    <a href="/materiais" class="btn btn-outline-secondary shadow-sm">
        <i class="bi bi-arrow-left"></i> Voltar ao Catálogo
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="/materiais" method="POST" enctype="multipart/form-data">
            @csrf <!-- Token de segurança obrigatório do Laravel -->

            <h5 class="text-muted mb-3 border-bottom pb-2">Informações Básicas</h5>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="codigo" class="form-label fw-bold">Código do Catálogo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="codigo" name="codigo" value="{{ old('codigo') }}" placeholder="Ex: SU-001" required>
                    @error('codigo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="descricao" class="form-label fw-bold">Descrição da Peça <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" value="{{ old('descricao') }}" placeholder="Ex: Marco Lateral Linha Suprema" required>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="cor" class="form-label fw-bold">Cor / Acabamento</label>
                    <input type="text" class="form-control @error('cor') is-invalid @enderror" id="cor" name="cor" value="{{ old('cor') }}" placeholder="Ex: Branco, Fosco">
                    <small class="text-muted">Deixe em branco se não se aplicar.</small>
                    @error('cor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h5 class="text-muted mt-4 mb-3 border-bottom pb-2">Classificação e Medidas</h5>
            <div class="row mb-4">
                <div class="col-md-3">
                    <label for="tipo" class="form-label fw-bold">Tipo de Material <span class="text-danger">*</span></label>
                    <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                        <option value="">Selecione...</option>
                        <option value="Perfil" {{ old('tipo') == 'Perfil' ? 'selected' : '' }}>Perfil de Alumínio</option>
                        <option value="Vidro" {{ old('tipo') == 'Vidro' ? 'selected' : '' }}>Vidro</option>
                        <option value="Acessório" {{ old('tipo') == 'Acessório' ? 'selected' : '' }}>Acessório / Componente</option>
                        <option value="Diversos" {{ old('tipo') == 'Diversos' ? 'selected' : '' }}>Diversos</option>
                    </select>
                    @error('tipo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="unidade_medida" class="form-label fw-bold">Unidade de Medida <span class="text-danger">*</span></label>
                    <select class="form-select @error('unidade_medida') is-invalid @enderror" id="unidade_medida" name="unidade_medida" required>
                        <option value="">Selecione...</option>
                        <option value="Barra" {{ old('unidade_medida') == 'Barra' ? 'selected' : '' }}>Barra</option>
                        <option value="Metro" {{ old('unidade_medida') == 'Metro' ? 'selected' : '' }}>Metro Linear</option>
                        <option value="M2" {{ old('unidade_medida') == 'M2' ? 'selected' : '' }}>Metro Quadrado (M²)</option>
                        <option value="Unidade" {{ old('unidade_medida') == 'Unidade' ? 'selected' : '' }}>Unidade (Peça)</option>
                    </select>
                    @error('unidade_medida')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="tamanho_padrao_mm" class="form-label fw-bold">Tamanho Padrão (mm)</label>
                    <input type="number" class="form-control @error('tamanho_padrao_mm') is-invalid @enderror" id="tamanho_padrao_mm" name="tamanho_padrao_mm" value="{{ old('tamanho_padrao_mm') }}" placeholder="Ex: 6000 (para barras)">
                    @error('tamanho_padrao_mm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h5 class="text-muted mt-4 mb-3 border-bottom pb-2">Imagem do Produto</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="imagem" class="form-label fw-bold">Anexar Foto ou Desenho Técnico</label>
                        <input type="file" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem" accept="image/jpeg, image/png, image/webp">
                        <small class="text-muted">Formatos aceites: JPG, PNG, WEBP. Tamanho máximo: 2MB.</small>
                        @error('imagem')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
            </div>


            <h5 class="text-muted mt-4 mb-3 border-bottom pb-2">Custos e Peso</h5>
            <div class="row mb-4">
                <div class="col-md-3">
                    <label for="peso_por_metro" class="form-label fw-bold">Peso por Metro (Kg)</label>
                    <div class="input-group">
                        <input type="number" step="0.001" min="0" class="form-control @error('peso_por_metro') is-invalid @enderror" id="peso_por_metro" name="peso_por_metro" value="{{ old('peso_por_metro') }}" placeholder="0.000">
                        <span class="input-group-text">Kg/m</span>
                    </div>
                    @error('peso_por_metro')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="preco_custo" class="form-label fw-bold">Preço de Custo <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" step="0.01" min="0" class="form-control @error('preco_custo') is-invalid @enderror" id="preco_custo" name="preco_custo" value="{{ old('preco_custo', '0.00') }}" required>
                    </div>
                    @error('preco_custo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-success fw-bold px-4 shadow-sm">
                    <i class="bi bi-floppy me-1"></i> Guardar Material
                </button>
            </div>
        </form>
    </div>
</div>
@endsection