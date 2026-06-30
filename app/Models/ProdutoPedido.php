<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class ProdutoPedido extends Model
{
    protected $table = 'produtosPedidos';
    protected $primaryKey = 'idItem';
    public $timestamps = false;
    protected $fillable = ['idPedido', 'idProduto', 'quantidade', 'precoUnitario'];
}

