<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    protected $table = 'imagens';
    protected $primaryKey = 'idImagem';
    public $timestamps = false;
    protected $fillable = ['nomeImagem', 'mimeType', 'dados'];
}
