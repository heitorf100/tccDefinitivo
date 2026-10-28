@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4 mt-3">
    <div>
        <a href="/clientes" class="text-decoration-none text-muted mb-2 d-inline-block">
            <i class="bi bi-arrow-left"></i> Voltar para a Carteira
        </a>
        <h2 class="fw-bold text-dark"><i class="bi bi-person-badge text-warning"></i> {{ $cliente->nome_razao }}</h2>
    </div>
    <div>
        <span class="badge bg-{{ $cliente->tipo_pessoa == 'PJ' ? 'primary' : 'success' }} fs-6 px-3 py-2">
            {{ $cliente->tipo_pessoa == 'PJ' ? 'Pessoa Jurídica (PJ)' : 'Pessoa Física (PF)' }}
        </span>
    </div>
</div>

<!-- Alertas de Sucesso / Erro -->
@if(session('sucesso'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('sucesso') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
@endif

<div class="row g-4">
    <!-- Informações Básicas -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 rounded-4 p-4 h-100">
            <h5 class="fw-bold text-dark mb-3"><i class="bi bi-info-circle text-primary"></i> Dados Cadastrais</h5>
            <p class="mb-2 text-muted"><strong>CPF / CNPJ:</strong><br>{{ $cliente->cpf_cnpj }}</p>
            <p class="mb-2 text-muted"><strong>Cadastrado em:</strong><br>{{ $cliente->created_at ? $cliente->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') : 'N/A' }}</p>
        </div>
    </div>

    <!-- Seção de Endereços de Obras / Faturamento -->
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4 p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-dark mb-0"><i class="bi bi-geo-alt text-danger"></i> Endereços de Obras / Faturamento</h5>
                <button class="btn btn-sm btn-outline-primary rounded-pill fw-semibold" data-bs-toggle="modal" data-bs-target="#modalNovoEndereco">
                    <i class="bi bi-plus-lg"></i> Adicionar Endereço
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tipo</th>
                            <th>Logradouro</th>
                            <th>Cidade/UF</th>
                            <th>CEP</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cliente->enderecos as $endereco)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $endereco->tipo_endereco }}</span></td>
                                <td>{{ $endereco->logradouro }}, {{ $endereco->numero }} - {{ $endereco->bairro }}</td>
                                <td>{{ $endereco->cidade }}/{{ $endereco->estado }}</td>
                                <td>{{ $endereco->cep }}</td>
                                <td class="text-end">
                                    <form action="/enderecos/{{ $endereco->id }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente excluir este endereço?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Excluir Endereço">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Nenhum endereço registado para este cliente.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Seção de Contatos -->
    <div class="col-md-12">
        <div class="card shadow-sm border-0 rounded-4 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-dark mb-0"><i class="bi bi-telephone text-success"></i> Contatos (Telefones e E-mails)</h5>
                <button class="btn btn-sm btn-outline-success rounded-pill fw-semibold" data-bs-toggle="modal" data-bs-target="#modalNovoContato">
                    <i class="bi bi-plus-lg"></i> Adicionar Contato
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Descrição / Observação</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cliente->contatos as $contato)
                            <tr>
                                <td><span class="badge bg-info text-dark">{{ $contato->tipo_contato }}</span></td>
                                <td class="fw-medium">
                                    @if(in_array($contato->tipo_contato, ['Telefone', 'Celular', 'WhatsApp']))
                                        {{ preg_replace('/^(\d{2})(\d{4,5})(\d{4})$/', '($1) $2-$3', preg_replace('/\D/', '', $contato->valor)) }}
                                    @else
                                        {{ $contato->valor }}
                                    @endif
                                </td>
                                <td class="text-muted">{{ $contato->descricao ?? 'Nenhuma' }}</td>
                                <td class="text-end">
                                    <form action="/contatos/{{ $contato->id }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente excluir este contacto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Excluir Contacto">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Nenhum contacto registado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Adicionar Endereço -->
<div class="modal fade" id="modalNovoEndereco" tabindex="-1" aria-labelledby="modalNovoEnderecoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark" id="modalNovoEnderecoLabel">
                    <i class="bi bi-geo-alt text-danger me-2"></i> Adicionar Endereço
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form action="/clientes/{{ $cliente->id }}/enderecos" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-9">
                            <label class="form-label fw-medium">Logradouro (Rua, Av, etc.) <span class="text-danger">*</span></label>
                            <input type="text" name="logradouro" class="form-control" required placeholder="Ex: Av. Brasil">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Número <span class="text-danger">*</span></label>
                            <input type="text" name="numero" class="form-control" required placeholder="Ex: 1500">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Bairro <span class="text-danger">*</span></label>
                            <input type="text" name="bairro" class="form-control" required placeholder="Ex: Centro">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Cidade <span class="text-danger">*</span></label>
                            <input type="text" name="cidade" class="form-control" required placeholder="Ex: Umuarama">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-medium">Estado (UF) <span class="text-danger">*</span></label>
                            <input type="text" name="estado" class="form-control" required maxlength="2" placeholder="PR">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-medium">CEP <span class="text-danger">*</span></label>
                            <input type="text" name="cep" class="form-control" required placeholder="87501-000">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-medium">Tipo de Endereço <span class="text-danger">*</span></label>
                            <select name="tipo_endereco" class="form-select" required>
                                <option value="Obra">Obra</option>
                                <option value="Residencial">Residencial</option>
                                <option value="Comercial">Comercial</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary fw-semibold">Salvar Endereço</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Adicionar Contato -->
<div class="modal fade" id="modalNovoContato" tabindex="-1" aria-labelledby="modalNovoContatoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark" id="modalNovoContatoLabel">
                    <i class="bi bi-telephone text-success me-2"></i> Adicionar Contato
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form action="/clientes/{{ $cliente->id }}/contatos" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Tipo <span class="text-danger">*</span></label>
                            <select name="tipo_contato" class="form-select" required>
                                <option value="Telefone">Telefone</option>
                                <option value="Celular">Celular</option>
                                <option value="WhatsApp">WhatsApp</option>
                                <option value="Email">Email</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Valor <span class="text-danger">*</span></label>
                            <input type="text" name="valor" class="form-control" required placeholder="(44) 99999-9999">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-medium">Descrição / Observação</label>
                            <input type="text" name="descricao" class="form-control" placeholder="Ex: Falar com o financeiro">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success fw-semibold">Salvar Contato</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection