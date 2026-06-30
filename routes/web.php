<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\produtoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PedidoController;




Route::get('/',                   [ProdutoController::class, 'index']);

Route::get('/carrinho',           [CarrinhoController::class, 'show'])->name('carrinho.show');
Route::post('/carrinho/adicionar',[CarrinhoController::class, 'store'])->name('carrinho.adicionar');
Route::post('/carrinho/aumentar', [CarrinhoController::class, 'aumentar'])->name('carrinho.aumentar');
Route::post('/carrinho/diminuir', [CarrinhoController::class, 'diminuir'])->name('carrinho.diminuir');
Route::post('/carrinho/remover',  [CarrinhoController::class, 'destroy'])->name('carrinho.remove');
Route::post('/carrinho/finalizar',[CarrinhoController::class, 'finalizar'])->name('carrinho.finalizar');
Route::post('/carrinho/pagar',    [CarrinhoController::class, 'pagar'])->name('carrinho.pagar');

Route::get('/produtos', [ProdutoController::class, 'index']);

Route::get('/garçom', function () {
    return view('garçom');
});


Route::get('/inicio', function () {
    return view('inicio');
});

Route::get('/login', function () {
    return view('login');
});
