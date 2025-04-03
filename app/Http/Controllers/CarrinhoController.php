<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarrinhoController extends Controller
{
    public function adicionar(Request $request)
    {
        $produtoId = $request->input('produto_id');
        $quantidade = $request->input('quantidade', 1);
        
        // Buscar informações do produto (simulado por enquanto)
        $produtos = $this->getProdutosDisponiveis();
        $produto = collect($produtos)->firstWhere('id', $produtoId);
        
        if (!$produto) {
            return redirect()->back()->with('erro', 'Produto não encontrado.');
        }
        
        // Adicionar ao carrinho na sessão
        $carrinho = Session::get('carrinho', []);
        
        if (isset($carrinho[$produtoId])) {
            $carrinho[$produtoId]['quantidade'] += $quantidade;
        } else {
            $carrinho[$produtoId] = [
                'id' => $produto['id'],
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'quantidade' => $quantidade,
                'subtotal' => $produto['preco'] * $quantidade
            ];
        }
        
        // Atualizar o subtotal
        $carrinho[$produtoId]['subtotal'] = $carrinho[$produtoId]['preco'] * $carrinho[$produtoId]['quantidade'];
        
        Session::put('carrinho', $carrinho);
        
        return redirect()->back()->with('sucesso', 'Produto adicionado ao carrinho.');
    }
    
    public function ver()
    {
        $itensCarrinho = Session::get('carrinho', []);
        $total = collect($itensCarrinho)->sum('subtotal');
        
        return view('carrinho.index', compact('itensCarrinho', 'total'));
    }
    
    public function remover($id)
    {
        $carrinho = Session::get('carrinho', []);
        
        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
            Session::put('carrinho', $carrinho);
        }
        
        return redirect()->route('carrinho.ver')->with('sucesso', 'Item removido do carrinho.');
    }
    
    public function atualizar(Request $request)
    {
        $carrinho = Session::get('carrinho', []);
        $quantidades = $request->input('quantidades', []);
        
        foreach ($quantidades as $id => $quantidade) {
            if (isset($carrinho[$id])) {
                $carrinho[$id]['quantidade'] = max(1, (int)$quantidade);
                $carrinho[$id]['subtotal'] = $carrinho[$id]['preco'] * $carrinho[$id]['quantidade'];
            }
        }
        
        Session::put('carrinho', $carrinho);
        
        return redirect()->route('carrinho.ver')->with('sucesso', 'Carrinho atualizado.');
    }
    
    public function limpar()
    {
        Session::forget('carrinho');
        return redirect()->route('carrinho.ver')->with('sucesso', 'Carrinho esvaziado.');
    }
    
    private function getProdutosDisponiveis()
    {
        // Simulação de produtos - futuramente virá do banco de dados
        return [
            [
                'id' => 1,
                'nome' => 'X-Burger',
                'descricao' => 'Hambúrguer, queijo, alface, tomate e maionese',
                'preco' => 15.90,
                'categoria' => 'Sanduíches'
            ],
            [
                'id' => 2,
                'nome' => 'X-Salada',
                'descricao' => 'Hambúrguer, queijo, alface, tomate, cebola e maionese',
                'preco' => 17.90,
                'categoria' => 'Sanduíches'
            ],
            [
                'id' => 3,
                'nome' => 'Refrigerante Lata',
                'descricao' => 'Refrigerante em lata 350ml',
                'preco' => 5.00,
                'categoria' => 'Bebidas'
            ],
            [
                'id' => 4,
                'nome' => 'Batata Frita',
                'descricao' => 'Porção de batata frita crocante',
                'preco' => 12.00,
                'categoria' => 'Acompanhamentos'
            ]
        ];
    }
}