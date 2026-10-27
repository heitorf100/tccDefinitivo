<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGEA - Gestão de Esquadrias</title>
    
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
            <a class="navbar-brand" href="/">
                <i class="bi bi-tools"></i> SGEA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/orcamentos"><i class="bi bi-file-earmark-text"></i> Orçamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tipologias"><i class="bi bi-grid"></i> Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/clientes"><i class="bi bi-people"></i> Clientes</a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center text-white">
                    <span class="me-3"><i class="bi bi-person-circle"></i> Usuário Logado</span>
                    <a href="#" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Área de Conteúdo Dinâmico (Aqui entram as outras telas) -->
    <main class="container">
        <!-- O Blade vai procurar a tag 'conteudo' nas outras páginas e injetar aqui -->
        @yield('conteudo')
    </main>

    <!-- Rodapé -->
    <footer class="text-center text-muted mt-5 pb-3">
        <hr>
        <small>&copy; {{ date('Y') }} SGEA - Sistema de Gestão e Controle de Corte de Alumínio. Todos os direitos reservados.</small>
    </footer>

    <!-- Scripts do Bootstrap (Necessário para menus dropdown e modais funcionarem) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>