@extends('layouts.app')

@section('conteudo')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        @if(session('sucesso'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('sucesso') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <i class="bi bi-tools text-dark" style="font-size: 2.5rem;"></i>
                    <h3 class="fw-bold mt-2">Acesso ao Esquadrimax</h3>
                    <p class="text-muted small">Entre com suas credenciais para gerenciar a fábrica</p>
                </div>

                <form action="/login" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="login_email" class="form-label fw-bold">E-mail</label>
                        <input type="email" class="form-control @error('login_email') is-invalid @enderror"
                               id="login_email" name="login_email" value="{{ old('login_email') }}"
                               placeholder="seuemail@esquadrimax.com" required autofocus>
                        @error('login_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="senha" class="form-label fw-bold">Senha</label>
                        <input type="password" class="form-control @error('senha') is-invalid @enderror"
                               id="senha" name="senha" required>
                        @error('senha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-dark w-100 fw-bold py-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a href="/usuarios/create" class="text-decoration-none small">Cadastrar novo usuário</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection