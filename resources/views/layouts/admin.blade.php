<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - B2 Bar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <meta http-equiv="refresh" content="30"> <!-- Atualiza a página a cada 30 segundos -->
    <style>
        :root {
            --primary: #e63946;
            --secondary: #457b9d;
            --dark: #1d3557;
            --light: #f1faee;
            --accent: #a8dadc;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .sidebar {
            background-color: var(--dark);
            min-height: 100vh;
            color: white;
        }
        
        .sidebar-heading {
            padding: 1.5rem 1rem;
            font-size: 1.2rem;
            font-weight: 700;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
            font-weight: 500;
            padding: 0.75rem 1rem;
        }
        
        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255,255,255,.1);
        }
        
        .sidebar .nav-link.active {
            color: white;
            background-color: var(--primary);
        }
        
        .sidebar .nav-link i {
            margin-right: 0.5rem;
        }
        
        .content {
            padding: 2rem;
        }
        
        .card-pedido {
            border-left: 5px solid;
            transition: all 0.2s ease;
        }
        
        .card-pedido:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .card-pedido.recebido {
            border-left-color: #ffc107;
        }
        
        .card-pedido.em_preparo {
            border-left-color: #0d6efd;
        }
        
        .card-pedido.pronto {
            border-left-color: #198754;
        }
        
        .card-pedido.entregue {
            border-left-color: #6c757d;
        }
        
        .card-pedido.cancelado {
            border-left-color: #dc3545;
        }
        
        .badge.status-recebido {
            background-color: #ffc107;
            color: #000;
        }
        
        .badge.status-em_preparo {
            background-color: #0d6efd;
        }
        
        .badge.status-pronto {
            background-color: #198754;
        }
        
        .badge.status-entregue {
            background-color: #6c757d;
        }
        
        .badge.status-cancelado {
            background-color: #dc3545;
        }
        
        .status-actions .dropdown-item:active {
            background-color: var(--primary);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="d-flex align-items-center sidebar-heading">
                    <span class="me-2" style="background-color: var(--primary); padding: 5px 8px; border-radius: 5px;">B2</span>
                    ADMIN
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.pedidos.recentes') ? 'active' : '' }}" href="{{ route('admin.pedidos.recentes') }}">
                            <i class="bi bi-bell"></i> Pedidos Recentes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.pedidos.index') ? 'active' : '' }}" href="{{ route('admin.pedidos.index') }}">
                            <i class="bi bi-list-check"></i> Todos os Pedidos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cardapio.index') }}" target="_blank">
                            <i class="bi bi-arrow-up-right-square"></i> Ver Site
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Content -->
            <div class="col-md-9 col-lg-10 content">
                @yield('content')
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Inicializa todos os tooltips
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
    @stack('scripts')
</body>
</html> 