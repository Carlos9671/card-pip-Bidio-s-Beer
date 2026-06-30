<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    protected $table = 'tipoProduto';
    protected $primaryKey = 'idTipoProduto';
    public $timestamps = false;
    protected $fillable = ['idTipo', 'idProduto'];
}
