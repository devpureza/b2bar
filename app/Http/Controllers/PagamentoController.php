<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PagamentoController extends Controller
{
    public function checkout()
    {
        $itensCarrinho = Session::get('carrinho', []);
        
        if (empty($itensCarrinho)) {
            return redirect()->route('cardapio.index')->with('erro', 'Seu carrinho está vazio.');
        }
        
        $total = collect($itensCarrinho)->sum('subtotal');
        
        return view('pagamento.checkout', compact('itensCarrinho', 'total'));
    }
    
    public function processar(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'forma_pagamento' => 'required|in:dinheiro,cartao,pix',
            'observacao' => 'nullable|string'
        ]);
        
        $itensCarrinho = Session::get('carrinho', []);
        
        if (empty($itensCarrinho)) {
            return redirect()->route('cardapio.index')->with('erro', 'Seu carrinho está vazio.');
        }
        
        // Calcular total
        $total = collect($itensCarrinho)->sum('subtotal');
        
        // Gerar número de pedido
        $numeroPedido = 'PED-' . strtoupper(substr(md5(uniqid()), 0, 8));
        
        // Criar pedido no banco de dados
        $pedido = Pedido::create([
            'numero_pedido' => $numeroPedido,
            'nome_cliente' => $request->nome,
            'forma_pagamento' => $request->forma_pagamento,
            'observacao' => $request->observacao,
            'total' => $total,
            'status' => Pedido::STATUS_RECEBIDO
        ]);
        
        // Adicionar itens do pedido
        foreach ($itensCarrinho as $item) {
            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $item['id'],
                'nome_produto' => $item['nome'],
                'preco_unitario' => $item['preco'],
                'quantidade' => $item['quantidade'],
                'subtotal' => $item['subtotal']
            ]);
        }
        
        // Limpar o carrinho
        Session::forget('carrinho');
        
        // Redirecionar para página de sucesso
        return redirect()->route('pagamento.sucesso', ['numero_pedido' => $numeroPedido]);
    }
    
    public function sucesso(Request $request)
    {
        $numeroPedido = $request->query('numero_pedido');
        
        if (!$numeroPedido) {
            return redirect()->route('cardapio.index');
        }
        
        return view('pagamento.sucesso', compact('numeroPedido'));
    }
}