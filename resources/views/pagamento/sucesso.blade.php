@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm text-center py-5">
                    <div class="card-body">
                        <div class="mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#28a745" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                        </div>
                        <h1 class="display-6 fw-bold mb-3">Pedido Realizado com Sucesso!</h1>
                        <div class="alert alert-success mx-auto mb-4" style="max-width: 400px;">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-receipt me-3 fs-1"></i>
                                <div class="text-start">
                                    <p class="mb-1 fw-bold">Número do seu pedido:</p>
                                    <h4 class="mb-0">{{ $numeroPedido }}</h4>
                                </div>
                            </div>
                        </div>
                        <p class="lead mb-4">Seu pedido foi recebido e está sendo preparado!</p>
                        <p class="text-muted mb-5">Você será chamado no balcão pelo número do pedido quando estiver pronto.</p>
                        
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="d-grid gap-3">
                                    <a href="{{ route('cardapio.index') }}" class="btn btn-primary py-2">
                                        <i class="bi bi-house-door me-2"></i> Voltar ao Cardápio
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3"><i class="bi bi-star me-2"></i> Avaliar sua experiência</h5>
                        <p class="card-text text-muted mb-3">Conte-nos como foi sua experiência com o B2 Bar! Sua opinião é muito importante para continuarmos melhorando.</p>
                        <div class="text-center mb-2">
                            <div class="btn-group" role="group" aria-label="Avaliação básica">
                                <button type="button" class="btn btn-outline-warning px-4">
                                    <i class="bi bi-emoji-frown fs-4 d-block mb-1"></i>
                                    Ruim
                                </button>
                                <button type="button" class="btn btn-outline-warning px-4">
                                    <i class="bi bi-emoji-neutral fs-4 d-block mb-1"></i>
                                    Regular
                                </button>
                                <button type="button" class="btn btn-outline-warning px-4">
                                    <i class="bi bi-emoji-smile fs-4 d-block mb-1"></i>
                                    Bom
                                </button>
                                <button type="button" class="btn btn-outline-warning px-4">
                                    <i class="bi bi-emoji-heart-eyes fs-4 d-block mb-1"></i>
                                    Excelente
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8 mt-5 text-center">
                <h4 class="fw-bold mb-4"><i class="bi bi-shop me-2"></i> B2 Bar - Sua lanchonete na empresa</h4>
                <p class="text-muted">Horário de funcionamento: Segunda a Sexta, das 8h às 18h</p>
                <p class="text-muted mb-4">Localização: Edifício Corporativo, 3º andar</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" class="btn btn-outline-dark rounded-circle p-2">
                        <i class="bi bi-facebook fs-5"></i>
                    </a>
                    <a href="#" class="btn btn-outline-dark rounded-circle p-2">
                        <i class="bi bi-instagram fs-5"></i>
                    </a>
                    <a href="#" class="btn btn-outline-dark rounded-circle p-2">
                        <i class="bi bi-whatsapp fs-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection 