<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_pedido',
        'nome_cliente',
        'forma_pagamento',
        'observacao',
        'total',
        'status'
    ];

    // Status possíveis para o pedido
    const STATUS_RECEBIDO = 'recebido';
    const STATUS_EM_PREPARO = 'em_preparo';
    const STATUS_PRONTO = 'pronto';
    const STATUS_ENTREGUE = 'entregue';
    const STATUS_CANCELADO = 'cancelado';

    public function itens()
    {
        return $this->hasMany(PedidoItem::class);
    }
}
