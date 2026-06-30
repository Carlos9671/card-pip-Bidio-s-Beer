<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('idProduto');
            $table->string('nomeProduto', 30)->unique();
            $table->unsignedInteger('idImagem')->nullable();
            $table->text('descricao')->nullable();
            $table->float('preco', 10, 2);
            $table->integer('quantidade')->default(10);
            $table->foreign('idImagem')->references('idImagem')->on('imagens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
