@extends('layouts.app')

@section('conteudo')
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h4 class="fw-bold mb-0"><i class="bi bi-person-plus me-2"></i>Novo Usuário</h4>
                    <a href="/login" class="btn btn-outline-secondary btn-sm">Voltar ao Login</a>
                </div>

                <form action="/usuarios" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nome" class="form-label fw-bold">Nome Completo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror"
                               id="nome" name="nome" value="{{ old('nome') }}" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="login_email" class="form-label fw-bold">E-mail de Acesso <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('login_email') is-invalid @enderror"
                               id="login_email" name="login_email" value="{{ old('login_email') }}" required>
                        @error('login_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cargo" class="form-label fw-bold">Cargo / Perfil <span class="text-danger">*</span></label>
                        <select class="form-select @error('cargo') is-invalid @enderror" id="cargo" name="cargo" required>
                            <option value="">Selecione...</option>
                            <option value="ADM" {{ old('cargo') == 'ADM' ? 'selected' : '' }}>Gestor / Administrador (ADM)</option>
                            <option value="PROD" {{ old('cargo') == 'PROD' ? 'selected' : '' }}>Equipe de Produção (PROD)</option>
                        </select>
                        @error('cargo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="senha" class="form-label fw-bold">Senha <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('senha') is-invalid @enderror"
                                   id="senha" name="senha" required>
                            @error('senha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="senha_confirmation" class="form-label fw-bold">Confirmar Senha <span class="text-danger">*</span></label>
                            <input type="password" class="form-control"
                                   id="senha_confirmation" name="senha_confirmation" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 fw-bold">
                        <i class="bi bi-check-circle me-1"></i> Cadastrar Usuário
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection