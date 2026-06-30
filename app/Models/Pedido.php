<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'idPedido';
    public $timestamps = false;
    protected $fillable = ['total', 'status', 'criado_em'];
}

