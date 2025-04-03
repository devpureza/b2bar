@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Pedidos Recentes</h1>
        <div>
            <span class="badge bg-info text-dark me-2">
                <i class="bi bi-arrow-clockwise"></i> Atualização automática a cada 30s
            </span>
            <a href="{{ route('admin.pedidos.recentes') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-clockwise"></i> Atualizar Agora
            </a>
        </div>
    </div>
    
    @if(session('sucesso'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('sucesso') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-bell"></i> Novos Pedidos</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @php $temPedidosNovos = false; @endphp
                        @foreach($pedidos as $pedido)
                            @if($pedido->status == 'recebido')
                                @php $temPedidosNovos = true; @endphp
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong>{{ $pedido->numero_pedido }}</strong>
                                        <small class="text-muted">{{ $pedido->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">Cliente: {{ $pedido->nome_cliente }}</p>
                                    <p class="mb-1">Total: R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>
                                    <div class="d-flex mt-2">
                                        <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST" class="me-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="em_preparo">
                                            <button type="submit" class="btn btn-sm btn-primary">Iniciar Preparo</button>
                                        </form>
                                        <a href="{{ route('admin.pedidos.detalhes', $pedido) }}" class="btn btn-sm btn-outline-secondary">Detalhes</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        @if(!$temPedidosNovos)
                            <div class="list-group-item text-center py-4">
                                <p class="text-muted mb-0">Nenhum pedido novo.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-hourglass-split"></i> Em Preparo</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @php $temPedidosEmPreparo = false; @endphp
                        @foreach($pedidos as $pedido)
                            @if($pedido->status == 'em_preparo')
                                @php $temPedidosEmPreparo = true; @endphp
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong>{{ $pedido->numero_pedido }}</strong>
                                        <small class="text-muted">{{ $pedido->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">Cliente: {{ $pedido->nome_cliente }}</p>
                                    <p class="mb-1">Total: R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>
                                    <div class="d-flex mt-2">
                                        <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST" class="me-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="pronto">
                                            <button type="submit" class="btn btn-sm btn-success">Marcar como Pronto</button>
                                        </form>
                                        <a href="{{ route('admin.pedidos.detalhes', $pedido) }}" class="btn btn-sm btn-outline-secondary">Detalhes</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        @if(!$temPedidosEmPreparo)
                            <div class="list-group-item text-center py-4">
                                <p class="text-muted mb-0">Nenhum pedido em preparo.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-check-circle"></i> Prontos para Entrega</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @php $temPedidosProntos = false; @endphp
                        @foreach($pedidos as $pedido)
                            @if($pedido->status == 'pronto')
                                @php $temPedidosProntos = true; @endphp
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong class="text-success">{{ $pedido->numero_pedido }}</strong>
                                        <small class="text-muted">{{ $pedido->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">Cliente: {{ $pedido->nome_cliente }}</p>
                                    <p class="mb-1">Total: R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>
                                    <div class="d-flex mt-2">
                                        <form action="{{ route('admin.pedidos.atualizar-status', $pedido) }}" method="POST" class="me-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="entregue">
                                            <button type="submit" class="btn btn-sm btn-secondary">Marcar como Entregue</button>
                                        </form>
                                        <a href="{{ route('admin.pedidos.detalhes', $pedido) }}" class="btn btn-sm btn-outline-secondary">Detalhes</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        @if(!$temPedidosProntos)
                            <div class="list-group-item text-center py-4">
                                <p class="text-muted mb-0">Nenhum pedido pronto para entrega.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mt-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Resumo das Atividades</h5>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="border rounded p-3">
                        <div class="h1 mb-0 text-warning">
                            {{ $pedidos->where('status', 'recebido')->count() }}
                        </div>
                        <div class="text-muted small">Pedidos Recebidos</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded p-3">
                        <div class="h1 mb-0 text-primary">
                            {{ $pedidos->where('status', 'em_preparo')->count() }}
                        </div>
                        <div class="text-muted small">Em Preparo</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded p-3">
                        <div class="h1 mb-0 text-success">
                            {{ $pedidos->where('status', 'pronto')->count() }}
                        </div>
                        <div class="text-muted small">Prontos para Entrega</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded p-3">
                        <div class="h1 mb-0 text-secondary">
                            {{ $pedidos->where('status', 'entregue')->count() }}
                        </div>
                        <div class="text-muted small">Entregues Hoje</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="{{ route('admin.pedidos.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-list-check me-1"></i> Ver Todos os Pedidos
            </a>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Reproduz som quando chegar um novo pedido
    document.addEventListener('DOMContentLoaded', function() {
        // Verificamos se há novos pedidos
        const newOrders = {{ $pedidos->where('status', 'recebido')->count() }};
        
        // Se houver pedidos novos e o usuário concedeu permissão para notificações
        if (newOrders > 0 && "Notification" in window) {
            // Verifica se já temos permissão
            if (Notification.permission === "granted") {
                // Cria uma notificação
                new Audio('/notification.mp3').play().catch(e => console.log('Erro ao reproduzir som: ', e));
            }
            else if (Notification.permission !== "denied") {
                // Pede permissão ao usuário
                Notification.requestPermission().then(function (permission) {
                    if (permission === "granted") {
                        new Audio('/notification.mp3').play().catch(e => console.log('Erro ao reproduzir som: ', e));
                    }
                });
            }
        }
    });
</script>
@endpush 