<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

    <!-- MODAL COMPRA -->
    <div class="modal" id="modal-compra">
        <div class="modal-conteudo">
            <h2>Obrigado pela compra! 🍺</h2>
            <p>Estaremos trazendo seus produtos conforme ficarem prontos. Caso queira comprar mais, basta pedir novamente!</p>
            <button id="fechar-modal">Fechar</button>
        </div>
    </div>

    <!-- MODAL PAGAR -->
    <div class="modal" id="modal-pagar">
        <div class="modal-conteudo">
            <h2>Obrigado pela presença! 🍺</h2>
            <p>Um garçom já virá até você para realizar o pagamento.</p>
            <button id="fechar-modal-pagar">Fechar</button>
        </div>
    </div>

    <!-- NAVBAR -->
    <header class="navbar">
        <h1 class="logo">Bidio's Beer Cardápio</h1>
        <nav>
            <a href="/inicio">Início</a>
            <a href="/produtos">Produtos</a>
            <a href="/carrinho">Carrinho</a>
            <a href="/garcom">Contato</a>
        </nav>
        <button class="btn_logout">Sair</button>
    </header>

    <main class="produtos_container">

        <aside class="sidebar">
            <h2>Resumo</h2>

                <div class="total">
                    <span>Total do pedido:</span>
                    <span class="total-pedido">R$ {{ number_format($valorTotal, 2, ',', '.') }}</span>
                </div>

            <form action="{{ route('carrinho.finalizar') }}" method="POST">
                @csrf
                <button type="submit" class="btn-comprar-carrinho">Comprar</button>
            </form>

            @if(session('sucesso'))
                <p class="valor-pagar">{{ session('sucesso') }}</p>
            @endif

                <div class="total">
                    <span>Valor total a pagar:</span>
                    <span class="total-pedido">R$ {{ number_format($valorPagar, 2, ',', '.') }}</span>
                </div>

            <form action="{{ route('carrinho.pagar') }}" method="POST">
                @csrf
                <button class="btn-pagar-carrinho" id="btn-pagar">Pagar</button>
            </form>
        </aside>

        <div class="grid_produtos">
            @forelse ($produtos as $produto)
                <div class="card_produto">
                    <img src="{{ asset('assets/' . $produto->nomeImagem) }}" alt="{{ $produto->nomeProduto }}">
                    <h3>{{ $produto->nomeProduto }}</h3>
                    <p>{{ $produto->descricao }}</p>
                    <span class="preco">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>

                    {{-- Botões + e - --}}
                    <div style="display:flex; align-items:center; gap:10px; margin-top:8px;">
                        <form action="{{ route('carrinho.diminuir') }}" method="POST">
                            @csrf
                            <input type="hidden" name="idProduto" value="{{ $produto->idProduto }}">
                            <button type="submit" class="btn-comprar-carrinho" style="width:36px; padding:4px;">−</button>
                        </form>

                        <span style="color:#fdf6e3; font-weight:600;">
                            {{ $carrinho[$produto->idProduto] ?? 1 }}
                        </span>

                        <form action="{{ route('carrinho.aumentar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="idProduto" value="{{ $produto->idProduto }}">
                            <button type="submit" class="btn-comprar-carrinho" style="width:36px; padding:4px;">+</button>
                        </form>
                    </div>

                    <form action="{{ route('carrinho.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="idProduto" value="{{ $produto->idProduto }}">
                        <button type="submit" class="btn-remover-carrinho">Remover</button>
                    </form>
                </div>
            @empty
                <p style="color:rgba(253,246,227,0.42); margin-left: calc(15% + 35px);">Seu carrinho está vazio.</p>
            @endforelse
        </div>

    </main>

</body>
</html>
