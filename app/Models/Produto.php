<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'idProduto';
    public $timestamps = false;
    protected $fillable = ['nomeProduto', 'idImagem', 'descricao', 'preco'];

    public function imagem()
    {
        return $this->belongsTo(Imagem::class, 'idImagem', 'idImagem');
    }

    public function listar()
    {
        $query = DB::table($this->table . ' as p')
            ->join('imagens as i', 'p.IdImagem', '=', 'i.idImagem')
            ->select('p.*', 'i.nomeImagem')
            ->get();

        return $query;
    }
}
