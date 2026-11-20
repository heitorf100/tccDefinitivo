@extends('layouts.app')

@section('conteudo')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i>Editar Tipologia</h3>
            <a href="/tipologias" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Voltar às Tipologias
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="/tipologias/{{ $tipologia->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="codigo_ref" class="form-label fw-bold">Código de Referência <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('codigo_ref') is-invalid @enderror"
                                   id="codigo_ref" name="codigo_ref" value="{{ old('codigo_ref', $tipologia->codigo_ref) }}" required>
                            @error('codigo_ref')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-8">
                            <label for="nome" class="form-label fw-bold">Nome da Esquadria <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                   id="nome" name="nome" value="{{ old('nome', $tipologia->nome) }}" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label fw-bold">Descrição Técnica / Observações Gerais</label>
                        <textarea class="form-control @error('descricao') is-invalid @enderror"
                                  id="descricao" name="descricao" rows="3">{{ old('descricao', $tipologia->descricao) }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="imagem" class="form-label fw-bold">Alterar Croqui / Desenho Técnico</label>
                        @if($tipologia->imagem_url)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $tipologia->imagem_url) }}" alt="Croqui atual"
                                     class="rounded border" style="height: 90px; object-fit: contain;">
                                <small class="text-muted d-block">Croqui atual (envie outro arquivo apenas se quiser substituir)</small>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('imagem') is-invalid @enderror"
                               id="imagem" name="imagem" accept="image/*">
                        @error('imagem')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/tipologias" class="btn btn-outline-secondary">Cancelar</a>
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