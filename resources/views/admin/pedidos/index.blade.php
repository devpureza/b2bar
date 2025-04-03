@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Todos os Pedidos</h1>
        <a href="{{ route('admin.pedidos.recentes') }}" class="btn btn-primary">
            <i class="bi bi-bell"></i> Ver Pedidos Recentes
        </a>
    </div>
    
    @if(session('sucesso'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('sucesso') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Pagamento</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pedidos as $pedido)
                            <tr>
                                <td><strong>{{ $pedido->numero_pedido }}</strong></td>
                                <td>{{ $pedido->nome_cliente }}</td>
                                <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                                <td>
                                    @if($pedido->forma_pagamento == 'dinheiro')
                                        <span class="badge bg-success">Dinheiro</span>
                                    @elseif($pedido->forma_pagamento == 'cartao')
                                        <span class="badge bg-primary">Cartão</span>
                                    @elseif($pedido->forma_pagamento == 'pix')
                                        <span class="badge bg-info text-dark">PIX</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge status-{{ $pedido->status }}">
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
                                </td>
                                <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.pedidos.detalhes', $pedido) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                                            Status
                                        </button>
                                        <div class="dropdown-menu status-actions">
                                            <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="recebido">
                                                <button type="submit" class="dropdown-item">Recebido</button>
                                            </form>
                                            <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="em_preparo">
                                                <button type="submit" class="dropdown-item">Em Preparo</button>
                                            </form>
                                            <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="pronto">
                                                <button type="submit" class="dropdown-item">Pronto</button>
                                            </form>
                                            <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="entregue">
                                                <button type="submit" class="dropdown-item">Entregue</button>
                                            </form>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="cancelado">
                                                <button type="submit" class="dropdown-item text-danger">Cancelar</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <p class="text-muted mb-0">Nenhum pedido encontrado.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection 