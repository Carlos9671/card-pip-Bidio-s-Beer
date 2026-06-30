<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produtos = [
            ['nomeProduto' => 'Hamburguer',   'idImagem' => 4, 'descricao' => 'Hamburguer artesanal',     'preco' => 29.90],
            ['nomeProduto' => 'Picanha',      'idImagem' => 7, 'descricao' => 'Picanha na brasa',          'preco' => 89.90],
            ['nomeProduto' => 'Nuggets',      'idImagem' => 5, 'descricao' => 'Porção de nuggets',         'preco' => 24.90],
            ['nomeProduto' => 'Churros',      'idImagem' => 1, 'descricao' => 'Churros com doce de leite', 'preco' => 14.90],
            ['nomeProduto' => 'Petit Gateau', 'idImagem' => 6, 'descricao' => 'Petit gateau quente',       'preco' => 19.90],
            ['nomeProduto' => 'Copo IPA',     'idImagem' => 2, 'descricao' => 'Cerveja IPA gelada',        'preco' => 12.90],
            ['nomeProduto' => 'Copo Pilsen',  'idImagem' => 3, 'descricao' => 'Cerveja Pilsen gelada',     'preco' => 10.90],
            ['nomeProduto' => 'Porção',       'idImagem' => 8, 'descricao' => 'Porção mista',              'preco' => 39.90],
        ];

        foreach ($produtos as $produto) {
            DB::table('produtos')->insert($produto);
        }
    }
}
