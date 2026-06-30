<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // idTipo: 1=Lanches, 2=Carnes, 3=Petiscos, 4=Bebidas, 5=Sobremesas
        // idProduto: 1=Hamburguer, 2=Picanha, 3=Nuggets, 4=Churros, 5=Petit Gateau, 6=Copo IPA, 7=Copo Pilsen, 8=Porção
        $vinculos = [
            ['idTipo' => 1, 'idProduto' => 3],  // Hamburguer -> Lanches
            ['idTipo' => 2, 'idProduto' => 4],  // Picanha -> Carnes
            ['idTipo' => 3, 'idProduto' => 5],  // Nuggets -> Petiscos
            ['idTipo' => 5, 'idProduto' => 6],  // Churros -> Sobremesas
            ['idTipo' => 5, 'idProduto' => 7],  // Petit Gateau -> Sobremesas
            ['idTipo' => 4, 'idProduto' => 8],  // Copo IPA -> Bebidas
            ['idTipo' => 4, 'idProduto' => 9],  // Copo Pilsen -> Bebidas
            ['idTipo' => 3, 'idProduto' => 10], // Porção -> Petiscos
        ];

        foreach ($vinculos as $vinculo) {
            DB::table('tiposprodutos')->insert($vinculo);
        }
    }
}
