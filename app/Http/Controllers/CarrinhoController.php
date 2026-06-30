<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class CarrinhoController extends Controller
{
    // Mostra o carrinho
    public function show()
    {
        //calcula o valor total do carrinho
        $carrinho = session()->get('carrinho', []);
        $ids = array_keys($carrinho);

        $produtos = Produto::whereIn('idProduto', $ids)->get();

        $valorTotal = $produtos->sum(function ($produto) use ($carrinho) {
            return $produto->preco * $carrinho[$produto->idProduto];
        });

        session(['valorTotal' => $valorTotal]);

        $valorPagar = session()->get('valorPagar', 0);

        return view('carrinho', compact('produtos', 'carrinho', 'valorTotal', 'valorPagar'));
    }

    // Adiciona produto ao carrinho
    public function store(Request $request)
    {
        $carrinho = session()->get('carrinho', []);
        $id = $request->idProduto;

        if (isset($carrinho[$id])) {
            $carrinho[$id]++;
        } else {
            $carrinho[$id] = 1;
        }

        ;

        session(['carrinho' => $carrinho]);

        return redirect()->back();
    }

    public function pagar()
    {
        $valorPagar = session()->get('valorPagar', 0);
        $valorPagar = 0;
        session(['valorPagar' => $valorPagar]);
        return redirect()->back()->with('sucesso', 'Pagamento realizado com sucesso!');
    }

    // Aumenta quantidade
    public function aumentar(Request $request)
    {
        $carrinho = session()->get('carrinho', []);
        $id = $request->idProduto;

            if (isset($carrinho[$id])) {
            $carrinho[$id]++;
        }

        session(['carrinho' => $carrinho]);

        return redirect()->back();
    }

    // Diminui quantidade
    public function diminuir(Request $request)
    {
        $carrinho = session()->get('carrinho', []);
        $id = $request->idProduto;

        if (isset($carrinho[$id])) {
            if ($carrinho[$id] > 1) {
                $carrinho[$id]--;
            } else {
                unset($carrinho[$id]); // remove se chegar a 0
            }
        }

        session(['carrinho' => $carrinho]);

        return redirect()->back();
    }

    // Remove produto
    public function destroy(Request $request)
    {
        $carrinho = session()->get('carrinho', []);
        unset($carrinho[$request->idProduto]);
        session(['carrinho' => $carrinho]);

        return redirect()->back();
    }

    // Finaliza compra e subtrai do banco
    public function finalizar()
    {
        $carrinho = session()->get('carrinho', []);

        if (empty($carrinho)) {
            return redirect()->back();
        }

        foreach ($carrinho as $idProduto => $quantidade) {
            $produto = Produto::find($idProduto);
            if ($produto) {
                $produto->quantidade = max(0, $produto->quantidade - $quantidade);
                $produto->save();
            }
        }

        //soma os valores totais para pagar no final
        $valorPagar = session()->get('valorPagar', 0);
            $valorTotal = session()->get('valorTotal', 0);
            $valorPagar += $valorTotal;

        session(['valorPagar' => $valorPagar]);
        session()->forget('carrinho');
        session()->forget('valorTotal');

        return redirect()->route('carrinho.show')->with('sucesso', 'Pedido realizado!');
    }
}
