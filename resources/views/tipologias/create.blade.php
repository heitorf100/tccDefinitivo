@extends('layouts.app')

@section('conteudo')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0"><i class="bi bi-plus-square me-2"></i>Nova Tipologia de Esquadria</h3>
            <a href="/tipologias" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Voltar às Tipologias
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="/tipologias" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="codigo_ref" class="form-label fw-bold">Código de Referência <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('codigo_ref') is-invalid @enderror"
                                   id="codigo_ref" name="codigo_ref" value="{{ old('codigo_ref') }}"
                                   placeholder="Ex: JAN-2F-SUP" required>
                            @error('codigo_ref')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-8">
                            <label for="nome" class="form-label fw-bold">Nome da Esquadria <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                   id="nome" name="nome" value="{{ old('nome') }}"
                                   placeholder="Ex: Janela de Correr 2 Folhas - Linha Suprema" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label fw-bold">Descrição Técnica / Observações Gerais</label>
                        <textarea class="form-control @error('descricao') is-invalid @enderror"
                                  id="descricao" name="descricao" rows="3"
                                  placeholder="Detalhes da linha, espessura de vidro recomendada, aplicação...">{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="imagem" class="form-label fw-bold">Croqui / Desenho Técnico da Esquadria</label>
                        <input type="file" class="form-control @error('imagem') is-invalid @enderror"
                               id="imagem" name="imagem" accept="image/*">
                        <small class="text-muted">Formatos aceitos: JPG, PNG ou WEBP (máx. 2MB).</small>
                        @error('imagem')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/tipologias" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success fw-bold">
                            <i class="bi bi-check-circle me-1"></i> Salvar e Montar Receita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection