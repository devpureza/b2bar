@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1 class="fw-bold mb-3">Seu Carrinho</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('cardapio.index') }}" class="text-decoration-none">Cardápio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Carrinho</li>
                    </ol>
                </nav>
            </div>
        </div>
        
        @if(session('sucesso'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('sucesso') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        @if(session('erro'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('erro') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        @if(count($itensCarrinho) > 0)
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Itens do Carrinho ({{ count($itensCarrinho) }})</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('carrinho.atualizar') }}" method="POST">
                                @csrf
                                @method('PUT')
                                @foreach($itensCarrinho as $id => $item)
                                    <div class="row mb-4 pb-3 border-bottom">
                                        <div class="col-md-8">
                                            <h5 class="mb-1">{{ $item['nome'] }}</h5>
                                            <p class="text-muted mb-2">Preço unitário: R$ {{ number_format($item['preco'], 2, ',', '.') }}</p>
                                            <div class="d-flex align-items-center">
                                                <div class="quantity-control me-3">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary qty-btn-minus">
                                                        <i class="bi bi-dash"></i>
                                                    </button>
                                                    <input type="number" name="quantidades[{{ $id }}]" value="{{ $item['quantidade'] }}" min="1" max="10" class="form-control form-control-sm qty-input">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary qty-btn-plus">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </div>
                                                <form action="{{ route('carrinho.remover', $id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm text-danger">
                                                        <i class="bi bi-trash"></i> Remover
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-md-end">
                                            <span class="price-tag">R$ {{ number_format($item['subtotal'], 2, ',', '.') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('cardapio.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-1"></i> Continuar Comprando
                                    </a>
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="bi bi-arrow-repeat me-1"></i> Atualizar Carrinho
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Resumo do Pedido</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <span>Subtotal</span>
                                <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Taxa de serviço</span>
                                <span>Grátis</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <strong>Total</strong>
                                <span class="price-tag">R$ {{ number_format($total, 2, ',', '.') }}</span>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="{{ route('pagamento.checkout') }}" class="btn btn-primary py-3">
                                    <i class="bi bi-credit-card me-2"></i> Finalizar Pedido
                                </a>
                                <form action="{{ route('carrinho.limpar') }}" method="POST" class="d-grid">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-x-circle me-2"></i> Limpar Carrinho
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card shadow-sm text-center py-5">
                <div class="card-body">
                    <i class="bi bi-basket display-1 text-muted mb-3"></i>
                    <h2>Seu carrinho está vazio</h2>
                    <p class="text-muted mb-4">Parece que você ainda não adicionou nenhum item ao seu carrinho.</p>
                    <a href="{{ route('cardapio.index') }}" class="btn btn-primary">Ver Cardápio</a>
                </div>
            </div>
        @endif
    </div>
    
    <script>
        // Script para os botões de quantidade
        document.addEventListener('DOMContentLoaded', function() {
            const minusBtns = document.querySelectorAll('.qty-btn-minus');
            const plusBtns = document.querySelectorAll('.qty-btn-plus');
            
            minusBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.parentNode.querySelector('.qty-input');
                    const value = parseInt(input.value);
                    if (value > 1) {
                        input.value = value - 1;
                    }
                });
            });
            
            plusBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.parentNode.querySelector('.qty-input');
                    const value = parseInt(input.value);
                    if (value < 10) {
                        input.value = value + 1;
                    }
                });
            });
        });
    </script>
@endsection 