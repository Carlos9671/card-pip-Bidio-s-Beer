<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagemSeeder extends Seeder
{
    public function run(): void
    {
        $imagens = [
            'churros.png',
            'copoIPA.png',
            'copoPILSEN.png',
            'hamburguer.png',
            'nuggets.png',
            'PetitGateau.png',
            'picanha.png',
            'porção.png',
        ];

        foreach ($imagens as $nome) {
            $caminho = database_path("seeders/assets/{$nome}");

            DB::table('imagens')->insert([
                'nomeImagem' => $nome,
                'mimeType'   => 'image/png',
                'dados'      => file_get_contents($caminho),
            ]);
        }
    }
}
