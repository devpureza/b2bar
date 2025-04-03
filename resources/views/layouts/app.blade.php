<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B2 Bar - Lanchonete da Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #e63946;
            --secondary: #457b9d;
            --dark: #1d3557;
            --light: #f1faee;
            --accent: #a8dadc;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 12px 0;
            background-color: var(--dark) !important;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .navbar-brand img {
            margin-right: 10px;
        }
        
        .navbar .nav-link {
            font-weight: 500;
            color: rgba(255,255,255,0.85) !important;
        }
        
        .navbar .nav-link:hover {
            color: white !important;
        }
        
        .navbar .nav-link.cart-icon {
            position: relative;
            font-size: 1.2rem;
        }
        
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            font-size: 0.7rem;
            color: white;
            background-color: var(--primary);
        }
        
        .hero-section {
            background: linear-gradient(rgba(29, 53, 87, 0.8), rgba(29, 53, 87, 0.9)), url('https://images.unsplash.com/photo-1513104890138-7c749659a591');
            background-size: cover;
            background-position: center;
            padding: 5rem 0;
            color: white;
            margin-bottom: 2rem;
            border-radius: 0 0 20px 20px;
        }
        
        .categoria-titulo {
            font-weight: 600;
            color: var(--dark);
            border-bottom: 3px solid var(--primary);
            padding-bottom: 10px;
            margin-top: 30px;
            display: inline-block;
        }
        
        .produto-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: none;
        }
        
        .produto-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: #d62c3b;
            border-color: #d62c3b;
        }
        
        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .text-primary {
            color: var(--primary) !important;
        }
        
        .price-tag {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary);
        }
        
        footer {
            background-color: var(--dark);
            color: white;
            padding: 3rem 0;
            margin-top: 5rem;
        }
        
        .logo-text {
            font-weight: 800;
            font-size: 24px;
            letter-spacing: -1px;
        }
        
        .logo-icon {
            background-color: var(--primary);
            padding: 5px 10px;
            border-radius: 8px;
            color: white;
            font-weight: 800;
            font-size: 20px;
            margin-right: 5px;
        }
        
        .quantity-control {
            display: flex;
            align-items: center;
            max-width: 120px;
        }
        
        .quantity-control input {
            text-align: center;
            border-radius: 0;
        }
        
        .quantity-control button {
            border-radius: 0;
        }
        
        .produto-img {
            height: 300px;
            width: 100%;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('cardapio.index') }}">
                <span class="logo-icon">B2</span>
                <span class="logo-text">BAR</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cardapio.index') ? 'active' : '' }}" href="{{ route('cardapio.index') }}">Cardápio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cart-icon {{ request()->routeIs('carrinho.ver') ? 'active' : '' }}" href="{{ route('carrinho.ver') }}">
                            <i class="bi bi-basket"></i>
                            @if(session()->has('carrinho') && count(session('carrinho')) > 0)
                                <span class="badge rounded-pill cart-badge">{{ count(session('carrinho')) }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="d-flex align-items-center mb-3">
                        <span class="logo-icon">B2</span>
                        <span class="logo-text">BAR</span>
                    </div>
                    <p>Sabor e qualidade para os melhores momentos da sua jornada de trabalho.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Horário de Funcionamento</h5>
                    <ul class="list-unstyled">
                        <li>Segunda a Sexta: 8h às 18h</li>
                        <li>Sábado: 9h às 14h</li>
                        <li>Domingo: Fechado</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contato</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt me-2"></i> Edifício Corporativo, 3º andar</li>
                        <li><i class="bi bi-telephone me-2"></i> (11) 1234-5678</li>
                        <li><i class="bi bi-envelope me-2"></i> contato@b2bar.com</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4 pt-4 border-top border-secondary">
                <div class="col-12 text-center">
                    <p class="mb-0">© {{ date('Y') }} B2 Bar - Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 