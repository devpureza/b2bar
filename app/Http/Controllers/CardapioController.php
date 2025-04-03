<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public function index()
    {
        // Aqui você vai carregar os produtos do cardápio do banco de dados futuramente
        // Por enquanto, vamos criar alguns produtos de exemplo com imagens
        $produtos = [
            [
                'id' => 1,
                'nome' => 'X-Burger',
                'descricao' => 'Hambúrguer, queijo, alface, tomate e maionese',
                'preco' => 15.90,
                'categoria' => 'Sanduíche',
                'imagem' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=600&h=600&fit=crop'
            ],
            [
                'id' => 2,
                'nome' => 'X-Salada',
                'descricao' => 'Hambúrguer, queijo, alface, tomate, cebola e maionese',
                'preco' => 17.90,
                'categoria' => 'Sanduíches',
                'imagem' => 'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=600&h=600&fit=crop'
            ],
            [
                'id' => 3,
                'nome' => 'Refrigerante Lata',
                'descricao' => 'Refrigerante em lata 350ml',
                'preco' => 5.00,
                'categoria' => 'Bebidas',
                'imagem' => 'https://images.unsplash.com/photo-1581636625402-29b2a704ef13?w=600&h=600&fit=crop'
            ],
            [
                'id' => 4,
                'nome' => 'Batata Frita',
                'descricao' => 'Porção de batata frita crocante',
                'preco' => 12.00,
                'categoria' => 'Acompanhamentos',
                'imagem' => 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=600&h=600&fit=crop'
            ],
            [
                'id' => 5,
                'nome' => 'Milk Shake',
                'descricao' => 'Milk shake cremoso de chocolate, morango ou baunilha',
                'preco' => 14.90,
                'categoria' => 'Bebidas',
                'imagem' => 'https://images.unsplash.com/photo-1577805947697-89e18249d767?w=600&h=600&fit=crop'
            ],
            [
                'id' => 6,
                'nome' => 'Combo Lanche + Batata + Bebida',
                'descricao' => 'X-Burger, batata média e refrigerante',
                'preco' => 28.90,
                'categoria' => 'Combos',
                'imagem' => 'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=600&h=600&fit=crop'
            ]
        ];

        return view('cardapio.index', compact('produtos'));
    }
}