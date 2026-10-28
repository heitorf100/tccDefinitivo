@extends('layouts.app')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4 mt-3">
    <h2 class="fw-bold text-dark"><i class="bi bi-people text-warning"></i> Carteira de Clientes</h2>
    
    <!-- Botão que abre o modal de cadastro -->
    <button type="button" class="btn btn-warning fw-semibold text-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#modalNovoCliente">
        <i class="bi bi-plus-lg"></i> Novo Cliente
    </button>
</div>

<!-- Alerta de Sucesso -->
@if(session('sucesso'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('sucesso') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
@endif

<!-- Alerta de Erros de Validação (CPF Inválido / Duplicado) -->
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Atenção!</strong> Verifique os dados informados:
        <ul class="mb-0 mt-1">
            @foreach($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
@endif



<!-- Tabela de Clientes -->
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-borderless align-middle mb-0">
                <thead class="table-light border-bottom">
                    <tr>
                        <th class="ps-4 py-3">Nome / Razão Social</th>
                        <th class="py-3">CPF / CNPJ</th>
                        <th class="py-3">Tipo</th>
                        <th class="pe-4 py-3 text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- O Blade faz um loop (forelse) para desenhar uma linha para cada cliente -->
                    @forelse($clientes as $cliente)
                        <tr class="border-bottom">
                            <td class="ps-4 fw-medium">{{ $cliente->nome_razao }}</td>
                            <td class="text-muted">{{ $cliente->cpf_cnpj }}</td>
                            <td>
                                <span class="badge bg-{{ $cliente->tipo_pessoa == 'PJ' ? 'primary' : 'success' }} bg-opacity-10 text-{{ $cliente->tipo_pessoa == 'PJ' ? 'primary' : 'success' }}">
                                    {{ $cliente->tipo_pessoa }}
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <!-- Botão para Visualizar o Perfil Completo -->
                                <a href="/clientes/{{ $cliente->id }}" class="btn btn-sm btn-outline-primary rounded-pill me-1" title="Ver Perfil, Endereços e Contatos">
                                    <i class="bi bi-eye"></i>
                                </a>
                                
                                <!-- Botão de Editar -->
                                <a href="/clientes/{{ $cliente->id }}/edit" class="btn btn-sm btn-outline-secondary rounded-pill me-1" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- Formulário de Exclusão (Método DELETE) -->
                                <form action="/clientes/{{ $cliente->id }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente excluir este cliente e todos os seus vínculos?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Excluir">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <!-- Mensagem exibida caso o banco de dados esteja vazio -->
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Nenhum cliente cadastrado ainda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Novo Cliente -->
<div class="modal fade" id="modalNovoCliente" tabindex="-1" aria-labelledby="modalNovoClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark" id="modalNovoClienteLabel">
                    <i class="bi bi-person-plus text-warning me-2"></i> Cadastrar Novo Cliente
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            
            <!-- O formulário aponta para a rota POST /clientes e usa o @csrf para segurança -->
            <form action="/clientes" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-medium">Nome / Razão Social <span class="text-danger">*</span></label>
                            <input type="text" name="nome_razao" class="form-control" required placeholder="Ex: João da Silva ou Construtora Alpha">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Tipo <span class="text-danger">*</span></label>
                            <select name="tipo_pessoa" class="form-select" required>
                                <option value="PF">Pessoa Física (PF)</option>
                                <option value="PJ">Pessoa Jurídica (PJ)</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-medium">CPF / CNPJ <span class="text-danger">*</span></label>
                            <input type="text" name="cpf_cnpj" class="form-control" required placeholder="Apenas números">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success fw-semibold">
                        <i class="bi bi-check-lg"></i> Salvar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script para Máscaras de Input -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cpfCnpjInput = document.querySelector('input[name="cpf_cnpj"]');

        // Máscara para CPF e CNPJ (dinâmica)
        cpfCnpjInput.addEventListener('input', function(e) {
            let v = e.target.value.replace(/\D/g, ""); // Remove tudo o que não é dígito

            if (v.length <= 11) { // CPF
                v = v.replace(/(\d{3})(\d)/, "$1.$2");
                v = v.replace(/(\d{3})(\d)/, "$1.$2");
                v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            } else { // CNPJ
                v = v.replace(/^(\d{2})(\d)/, "$1.$2");
                v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
                v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
                v = v.replace(/(\d{4})(\d)/, "$1-$2");
            }
            // Limita a 18 caracteres (tamanho máximo de um CNPJ formatado)
            e.target.value = v.substring(0, 18);
        });
    });
</script>

@endsection