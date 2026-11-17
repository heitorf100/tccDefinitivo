<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esquadrimax - Gestão de Esquadrias</title>
    
    <!-- CSS do Bootstrap 5 (Via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Ícones do Bootstrap (Via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
    </style>
</head>
<body>

    <!-- Menu Superior (Navbar) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="/">
                <i class="bi bi-tools me-1"></i> Esquadrimax
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="menuPrincipal">
                @auth
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/orcamentos"><i class="bi bi-file-earmark-text"></i> Orçamentos</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-grid"></i> Catálogo
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/tipologias"><i class="bi bi-window me-1"></i> Tipologias (Esquadrias)</a></li>
                                <li><a class="dropdown-item" href="/materiais"><i class="bi bi-box-seam me-1"></i> Materiais (Insumos)</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/clientes"><i class="bi bi-people"></i> Clientes</a>
                        </li>
                    </ul>
                    
                    <div class="d-flex align-items-center text-white">
                        <span class="me-3"><i class="bi bi-person-circle me-1"></i> {{ Auth::user()->nome }}</span>
                        <form action="/logout" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">
                                <i class="bi bi-box-arrow-right"></i> Sair
                            </button>
                        </form>
                    </div>
                @else
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/login"><i class="bi bi-box-arrow-in-right me-1"></i> Entrar</a>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Área de Conteúdo Dinâmico -->
    <main class="container">
        @yield('conteudo')
    </main>

    <!-- Rodapé -->
    <footer class="text-center text-muted py-4 mt-4">
        <small>&copy; 2026 Esquadrimax - Sistema de Gestão e Controle de Esquadrias e Alumínio. Todos os direitos reservados.</small>
    </footer>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>