@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0"><i class="bi bi-list-check me-2"></i>Ficha Técnica e Receita de Corte</h3>
        <p class="text-muted mb-0">Defina os perfis, vidros e acessórios consumidos por este modelo</p>
    </div>
    <div class="d-flex gap-2">
        <a href="/tipologias/{{ $tipologia->id }}/edit" class="btn btn-outline-primary">
            <i class="bi bi-pencil me-1"></i> Editar Modelo
        </a>
        <a href="/tipologias" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Voltar às Tipologias
        </a>
    </div>
</div>

@if(session('sucesso'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('sucesso') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Verifique os campos abaixo:</strong>
        <ul class="mb-0 mt-1">
            @foreach($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Cabeçalho da Tipologia -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <div class="row g-4 align-items-center">
            <div class="col-md-3 text-center">
                @if($tipologia->imagem_url)
                    <img src="{{ asset('storage/' . $tipologia->imagem_url) }}"
                         alt="{{ $tipologia->codigo_ref }}"
                         class="img-fluid rounded border shadow-sm"
                         style="max-height: 180px; object-fit: contain;">
                @else
                    <div class="bg-light border rounded d-flex flex-column align-items-center justify-content-center text-muted p-3"
                         style="height: 160px;">
                        <i class="bi bi-window" style="font-size: 2.5rem;"></i>
                        <small class="mt-1">Sem croqui</small>
                    </div>
                @endif
            </div>
            <div class="col-md-9">
                <span class="badge bg-dark mb-2">{{ $tipologia->codigo_ref }}</span>
                <h4 class="fw-bold mb-2">{{ $tipologia->nome }}</h4>
                <p class="text-muted mb-0">{{ $tipologia->descricao ?? 'Nenhuma descrição técnica informada.' }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Formulário para Adicionar Material à Receita -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-dark text-white fw-bold">
        <i class="bi bi-plus-circle me-1"></i> Adicionar Insumo / Regra de Corte à Receita
    </div>
    <div class="card-body">
        <form action="/tipologias/{{ $tipologia->id }}/materiais" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-5">
                    <label for="material_id" class="form-label fw-bold">Material do Catálogo <span class="text-danger">*</span></label>
                    <select class="form-select" id="material_id" name="material_id" required>
                        <option value="">Selecione um material...</option>
                        @foreach($materiaisDisponiveis as $mat)
                            <option value="{{ $mat->id }}" {{ old('material_id') == $mat->id ? 'selected' : '' }}>
                                {{ $mat->codigo }} - {{ $mat->descricao }} {{ $mat->cor ? '(' . $mat->cor . ')' : '' }} [{{ $mat->unidade_medida }}]
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="tipo_calculo" class="form-label fw-bold">Base de Cálculo <span class="text-danger">*</span></label>
                    <select class="form-select" id="tipo_calculo" name="tipo_calculo" required>
                        <option value="">Selecione...</option>
                        <option value="LARGURA" {{ old('tipo_calculo') == 'LARGURA' ? 'selected' : '' }}>LARGURA (Perfil Horizontal)</option>
                        <option value="ALTURA" {{ old('tipo_calculo') == 'ALTURA' ? 'selected' : '' }}>ALTURA (Perfil Vertical)</option>
                        <option value="AREA" {{ old('tipo_calculo') == 'AREA' ? 'selected' : '' }}>ÁREA (m² - Vidro / Chapa)</option>
                        <option value="UNIDADE" {{ old('tipo_calculo') == 'UNIDADE' ? 'selected' : '' }}>UNIDADE (Acessório / Kit Fixo)</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="quantidade_pecas" class="form-label fw-bold">Qtd. Peças <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="quantidade_pecas" name="quantidade_pecas"
                           value="{{ old('quantidade_pecas', 1) }}" min="1" max="999" required>
                </div>

                <div class="col-md-2">
                    <label for="desconto_largura_mm" class="form-label fw-bold">Desc. Larg. (mm)</label>
                    <input type="number" class="form-control" id="desconto_largura_mm" name="desconto_largura_mm"
                           value="{{ old('desconto_largura_mm', 0) }}" placeholder="Ex: -45">
                </div>

                <div class="col-md-2">
                    <label for="desconto_altura_mm" class="form-label fw-bold">Desc. Alt. (mm)</label>
                    <input type="number" class="form-control" id="desconto_altura_mm" name="desconto_altura_mm"
                           value="{{ old('desconto_altura_mm', 0) }}" placeholder="Ex: -60">
                </div>

                <div class="col-md-7">
                    <label for="observacao_corte" class="form-label fw-bold">Observação de Corte / Montagem</label>
                    <input type="text" class="form-control" id="observacao_corte" name="observacao_corte"
                           value="{{ old('observacao_corte') }}"
                           placeholder="Ex: Corte 45º, Trilho superior, Roldana folha móvel...">
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100 fw-bold">
                        <i class="bi bi-plus-lg me-1"></i> Adicionar à Receita
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tabela da Receita Montada -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
        <span><i class="bi bi-tools me-1"></i> Composição Atual da Esquadria</span>
        <span class="badge bg-secondary">{{ $tipologia->materiais->count() }} {{ $tipologia->materiais->count() == 1 ? 'item' : 'itens' }}</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Código</th>
                        <th>Material</th>
                        <th>Base de Cálculo</th>
                        <th class="text-center">Qtd. Peças</th>
                        <th class="text-center">Desc. Largura</th>
                        <th class="text-center">Desc. Altura</th>
                        <th>Observação de Corte</th>
                        <th class="text-end">Remover</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tipologia->materiais as $item)
                        <tr>
                            <td class="fw-bold">{{ $item->codigo }}</td>
                            <td>
                                {{ $item->descricao }}
                                @if($item->cor)
                                    <small class="text-muted d-block">Cor: {{ $item->cor }}</small>
                                @endif
                            </td>
                            <td>
                                @php
                                    $coresBadge = [
                                        'LARGURA' => 'bg-primary',
                                        'ALTURA'  => 'bg-info text-dark',
                                        'AREA'    => 'bg-warning text-dark',
                                        'UNIDADE' => 'bg-secondary',
                                    ];
                                @endphp
                                <span class="badge {{ $coresBadge[$item->pivot->tipo_calculo] ?? 'bg-dark' }}">
                                    {{ $item->pivot->tipo_calculo }}
                                </span>
                            </td>
                            <td class="text-center fw-bold">{{ $item->pivot->quantidade_pecas }}x</td>
                            <td class="text-center">{{ $item->pivot->desconto_largura_mm }} mm</td>
                            <td class="text-center">{{ $item->pivot->desconto_altura_mm }} mm</td>
                            <td class="text-muted">{{ $item->pivot->observacao_corte ?? '-' }}</td>
                            <td class="text-end">
                                <form action="/tipologias/{{ $tipologia->id }}/materiais/{{ $item->pivot->id }}" method="POST"
                                      onsubmit="return confirm('Remover este item da receita?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Remover item">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                Nenhum material vinculado ainda. Use o formulário acima para montar a receita desta esquadria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection