@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Detalhes do Pedido</h1>
        <div>
            <a href="{{ route('admin.pedidos.recentes') }}" class="btn btn-outline-primary me-2">
                <i class="bi bi-bell"></i> Pedidos Recentes
            </a>
            <a href="{{ route('admin.pedidos.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Itens do Pedido</h5>
                    <span class="badge status-{{ $pedido->status }} fs-6">
                        @if($pedido->status == 'recebido')
                            Recebido
                        @elseif($pedido->status == 'em_preparo')
                            Em Preparo
                        @elseif($pedido->status == 'pronto')
                            Pronto
                        @elseif($pedido->status == 'entregue')
                            Entregue
                        @elseif($pedido->status == 'cancelado')
                            Cancelado
                        @endif
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Preço</th>
                                    <th>Quantidade</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedido->itens as $item)
                                    <tr>
                                        <td>{{ $item->nome_produto }}</td>
                                        <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                                        <td>{{ $item->quantidade }}</td>
                                        <td class="text-end">R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total:</td>
                                    <td class="text-end fw-bold">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    @if($pedido->observacao)
                        <div class="alert alert-info mt-3">
                            <h6 class="mb-1"><i class="bi bi-info-circle me-1"></i> Observações:</h6>
                            <p class="mb-0">{{ $pedido->observacao }}</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Atualizar Status</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="recebido">
                            <button type="submit" class="btn {{ $pedido->status == 'recebido' ? 'btn-warning' : 'btn-outline-warning' }}">
                                <i class="bi bi-bell me-1"></i> Recebido
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="em_preparo">
                            <button type="submit" class="btn {{ $pedido->status == 'em_preparo' ? 'btn-primary' : 'btn-outline-primary' }}">
                                <i class="bi bi-hourglass-split me-1"></i> Em Preparo
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="pronto">
                            <button type="submit" class="btn {{ $pedido->status == 'pronto' ? 'btn-success' : 'btn-outline-success' }}">
                                <i class="bi bi-check-circle me-1"></i> Pronto
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="entregue">
                            <button type="submit" class="btn {{ $pedido->status == 'entregue' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                                <i class="bi bi-bag-check me-1"></i> Entregue
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="cancelado">
                            <button type="submit" class="btn {{ $pedido->status == 'cancelado' ? 'btn-danger' : 'btn-outline-danger' }}">
                                <i class="bi bi-x-circle me-1"></i> Cancelar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Informações do Pedido</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Número do Pedido:</span>
                            <strong>{{ $pedido->numero_pedido }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Data/Hora:</span>
                            <span>{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Cliente:</span>
                            <span>{{ $pedido->nome_cliente }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Forma de Pagamento:</span>
                            @if($pedido->forma_pagamento == 'dinheiro')
                                <span class="badge bg-success">Dinheiro</span>
                            @elseif($pedido->forma_pagamento == 'cartao')
                                <span class="badge bg-primary">Cartão</span>
                            @elseif($pedido->forma_pagamento == 'pix')
                                <span class="badge bg-info text-dark">PIX</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Ações</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary" onclick="window.print()">
                            <i class="bi bi-printer me-1"></i> Imprimir Pedido
                        </button>
                        
                        <a href="{{ route('admin.pedidos.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Voltar para Lista
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Dica</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">
                        <i class="bi bi-lightbulb me-1 text-warning"></i>
                        Atualize o status para <strong>"Pronto"</strong> quando o pedido estiver pronto para ser entregue ao cliente.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection 