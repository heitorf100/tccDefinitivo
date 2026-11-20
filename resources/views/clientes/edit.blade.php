@extends('layouts.app')

@section('conteudo')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0"><i class="bi bi-pencil-square text-warning me-2"></i>Editar Cliente</h3>
            <a href="/clientes" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Voltar para a Carteira
            </a>
        </div>

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

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <form action="/clientes/{{ $cliente->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <label for="nome_razao" class="form-label fw-bold">Nome / Razão Social <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nome_razao') is-invalid @enderror"
                                   id="nome_razao" name="nome_razao"
                                   value="{{ old('nome_razao', $cliente->nome_razao) }}" required>
                            @error('nome_razao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="tipo_pessoa" class="form-label fw-bold">Tipo <span class="text-danger">*</span></label>
                            @php $tipoAtual = old('tipo_pessoa', $cliente->tipo_pessoa); @endphp
                            <select class="form-select @error('tipo_pessoa') is-invalid @enderror" id="tipo_pessoa" name="tipo_pessoa" required>
                                <option value="PF" {{ $tipoAtual == 'PF' ? 'selected' : '' }}>Pessoa Física (PF)</option>
                                <option value="PJ" {{ $tipoAtual == 'PJ' ? 'selected' : '' }}>Pessoa Jurídica (PJ)</option>
                            </select>
                            @error('tipo_pessoa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="cpf_cnpj" class="form-label fw-bold">CPF / CNPJ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('cpf_cnpj') is-invalid @enderror"
                                   id="cpf_cnpj" name="cpf_cnpj"
                                   value="{{ old('cpf_cnpj', $cliente->cpf_cnpj) }}" required>
                            @error('cpf_cnpj')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/clientes" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="bi bi-save me-1"></i> Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cpfCnpjInput = document.getElementById('cpf_cnpj');

        cpfCnpjInput.addEventListener('input', function(e) {
            let v = e.target.value.replace(/\D/g, "");

            if (v.length <= 11) {
                v = v.replace(/(\d{3})(\d)/, "$1.$2");
                v = v.replace(/(\d{3})(\d)/, "$1.$2");
                v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            } else {
                v = v.replace(/^(\d{2})(\d)/, "$1.$2");
                v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
                v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
                v = v.replace(/(\d{4})(\d)/, "$1-$2");
            }

            e.target.value = v.substring(0, 18);
        });
    });
</script>
@endsection