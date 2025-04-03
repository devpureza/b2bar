<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PagamentoController;


Route::get('/', [CardapioController::class, 'index'])->name('cardapio.index');

// Carrinho
Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
Route::get('/carrinho', [CarrinhoController::class, 'ver'])->name('carrinho.ver');
Route::delete('/carrinho/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
Route::put('/carrinho/atualizar', [CarrinhoController::class, 'atualizar'])->name('carrinho.atualizar');
Route::delete('/carrinho', [CarrinhoController::class, 'limpar'])->name('carrinho.limpar');

// Pagamento
Route::get('/checkout', [PagamentoController::class, 'checkout'])->name('pagamento.checkout');
Route::post('/checkout/processar', [PagamentoController::class, 'processar'])->name('pagamento.processar');
Route::get('/pedido/sucesso', [PagamentoController::class, 'sucesso'])->name('pagamento.sucesso');
