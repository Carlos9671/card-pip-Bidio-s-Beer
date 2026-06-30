<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = ['lanches', 'carnes', 'petiscos', 'bebidas', 'sobremesas'];

        foreach ($tipos as $tipo) {
            DB::table('tipos')->insert(['nomeTipo' => $tipo]);
        }
    }
}
