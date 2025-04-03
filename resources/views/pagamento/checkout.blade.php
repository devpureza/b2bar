@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1 class="fw-bold mb-3">Finalizar Pedido</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('cardapio.index') }}" class="text-decoration-none">Cardápio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('carrinho.ver') }}" class="text-decoration-none">Carrinho</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Informações do Pedido</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pagamento.processar') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="nome" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" placeholder="Digite seu nome completo" required>
                                @error('nome')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Forma de Pagamento</label>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="form-check border rounded p-3">
                                            <input class="form-check-input" type="radio" name="forma_pagamento" id="pagamento_dinheiro" value="dinheiro" {{ old('forma_pagamento') == 'dinheiro' ? 'checked' : '' }} required>
                                            <label class="form-check-label w-100" for="pagamento_dinheiro">
                                                <i class="bi bi-cash-coin me-2 text-success"></i> Dinheiro
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check border rounded p-3">
                                            <input class="form-check-input" type="radio" name="forma_pagamento" id="pagamento_cartao" value="cartao" {{ old('forma_pagamento') == 'cartao' ? 'checked' : '' }} required>
                                            <label class="form-check-label w-100" for="pagamento_cartao">
                                                <i class="bi bi-credit-card me-2 text-primary"></i> Cartão
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check border rounded p-3">
                                            <input class="form-check-input" type="radio" name="forma_pagamento" id="pagamento_pix" value="pix" {{ old('forma_pagamento') == 'pix' ? 'checked' : '' }} required>
                                            <label class="form-check-label w-100" for="pagamento_pix">
                                                <i class="bi bi-qr-code me-2 text-primary"></i> PIX
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @error('forma_pagamento')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="observacao" class="form-label">Observações</label>
                                <textarea class="form-control" id="observacao" name="observacao" rows="3" placeholder="Instruções especiais, preferências ou alergias...">{{ old('observacao') }}</textarea>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('carrinho.ver') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Voltar ao Carrinho
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-1"></i> Confirmar Pedido
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
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($itensCarrinho as $item)
                                <li class="list-group-item px-0 d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $item['nome'] }}</div>
                                        <span class="text-muted">{{ $item['quantidade'] }} x R$ {{ number_format($item['preco'], 2, ',', '.') }}</span>
                                    </div>
                                    <span>R$ {{ number_format($item['subtotal'], 2, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Taxa de serviço</span>
                            <span>Grátis</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-0">
                            <strong>Total</strong>
                            <span class="price-tag">R$ {{ number_format($total, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 