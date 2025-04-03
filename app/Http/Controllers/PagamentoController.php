<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        
        // Aqui você processaria o pedido e salvaria no banco de dados
        // Para este exemplo, apenas simularemos o processo
        
        // Gerar número de pedido
        $numeroPedido = 'PED-' . strtoupper(substr(md5(uniqid()), 0, 8));
        
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