@extends('layouts.app')

@section('content')
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">B2 Bar</h1>
            <p class="lead mb-4">Sabor e qualidade para os melhores momentos da sua jornada</p>
        </div>
    </section>

    <div class="container">
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

        @php
            $categorias = collect($produtos)->groupBy('categoria');
        @endphp

        @foreach($categorias as $categoria => $itens)
            <section class="mb-5">
                <h2 class="categoria-titulo mb-4">{{ $categoria }}</h2>
                <div class="row g-4">
                    @foreach($itens as $produto)
                        <div class="col-md-6 col-lg-4">
                            <div class="produto-card card h-100">
                                <img src="{{ $produto['imagem'] }}" class="produto-img" alt="{{ $produto['nome'] }}">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title">{{ $produto['nome'] }}</h5>
                                        <span class="price-tag">R$ {{ number_format($produto['preco'], 2, ',', '.') }}</span>
                                    </div>
                                    <p class="card-text text-muted flex-grow-1">{{ $produto['descricao'] }}</p>
                                    <form action="{{ route('carrinho.adicionar') }}" method="POST" class="mt-auto">
                                        @csrf
                                        <input type="hidden" name="produto_id" value="{{ $produto['id'] }}">
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <div class="quantity-control">
                                                <button type="button" class="btn btn-sm btn-outline-secondary qty-btn-minus">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <input type="number" name="quantidade" value="1" min="1" max="10" class="form-control form-control-sm qty-input">
                                                <button type="button" class="btn btn-sm btn-outline-secondary qty-btn-plus">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                            <button type="submit" class="btn btn-primary ms-2">
                                                <i class="bi bi-basket me-1"></i> Adicionar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach
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