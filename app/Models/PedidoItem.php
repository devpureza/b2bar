<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'nome_produto',
        'preco_unitario',
        'quantidade',
        'subtotal'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
