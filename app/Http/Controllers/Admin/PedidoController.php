<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::orderBy('created_at', 'desc')->get();
        return view('admin.pedidos.index', compact('pedidos'));
    }
    
    public function atualizarStatus(Request $request, Pedido $pedido)
    {
        $request->validate([
            'status' => 'required|in:recebido,em_preparo,pronto,entregue,cancelado'
        ]);
        
        $pedido->status = $request->status;
        $pedido->save();
        
        return redirect()->route('admin.pedidos.index')->with('sucesso', 'Status do pedido atualizado com sucesso.');
    }
    
    public function detalhes(Pedido $pedido)
    {
        return view('admin.pedidos.detalhes', compact('pedido'));
    }
    
    public function pedidosRecentes()
    {
        $pedidos = Pedido::whereIn('status', [
            Pedido::STATUS_RECEBIDO, 
            Pedido::STATUS_EM_PREPARO, 
            Pedido::STATUS_PRONTO
        ])->orderBy('created_at', 'desc')->get();
        
        return view('admin.pedidos.recentes', compact('pedidos'));
    }
} 