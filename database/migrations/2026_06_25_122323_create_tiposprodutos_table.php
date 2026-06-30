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
        Schema::create('tiposprodutos', function (Blueprint $table) {
            $table->increments('idTipoProduto');
            $table->unsignedInteger('idTipo')->nullable();
            $table->unsignedInteger('idProduto')->nullable();
            $table->foreign('idTipo')->references('idTipo')->on('tipos');
            $table->foreign('idProduto')->references('idProduto')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiposprodutos');
    }
};
