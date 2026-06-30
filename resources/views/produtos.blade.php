<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <h1 class="logo">Bidio's Beer Cardápio</h1>
        <nav>
            <a href="/inicio">Início</a>
            <a href="/produtos" class="ativo">Produtos</a>
            <a href="{{ route('carrinho.show') }}">
                Carrinho
            </a>
            <a href="/garcom">Contato</a>
            <a href="/admin">Admin</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn_logout">Sair</button>
        </form>
    </header>

    <!-- CONTEÚDO -->
    <main class="produtos_container">

        <aside class="sidebar">
            <h2>Filtros</h2>
            <div class="filtrosnome">
                <button class="filtro" data-filtro="Bebidas">Bebidas</button>
                <button class="filtro" data-filtro="Carnes">Carnes</button>
                <button class="filtro" data-filtro="Petiscos">Petiscos</button>
                <button class="filtro" data-filtro="Sobremesas">Sobremesas</button>
                <button class="filtro" data-filtro="Lanches">Lanches</button>
            </div>
        </aside>

        <h2 class="nossosprodutos">Nossos Produtos</h2>


        <div class="grid_produtos">
            @foreach($produtos as $produto)
                <div class="card_produto">
                    <img src="{{ asset('assets/' . $produto->nomeImagem) }}" alt="{{ $produto->nomeImagem }}">
                    <h3>{{ $produto->nomeProduto }}</h3>
                    <p>{{ $produto->descricao }}</p>
                    <span class="preco">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                    <form action="{{ route('carrinho.adicionar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="idProduto" value="{{ $produto->idProduto }}">
                        <button type="submit" id="botarCarrinho-btn">Adicionar ao Carrinho</button>
                    </form>
                </div>
            @endforeach
        </div>


    </main>

    <div class="toast" id="toast"></div>

</body>
</html>
