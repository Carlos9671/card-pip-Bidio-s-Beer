/* Login */
const formLogin = document.querySelector('.form_login')
const formCadastro = document.querySelector('.form_cadastro')
const botaoCadastro = document.querySelector('#botao_cadastro')
const botaoLogin = document.querySelector('#botao_login')

if (botaoCadastro && botaoLogin) {
    botaoCadastro.addEventListener('click', function() {
        formLogin.classList.remove('ativo')
        formCadastro.classList.add('ativo')
    })
    botaoLogin.addEventListener('click', function() {
        formCadastro.classList.remove('ativo')
        formLogin.classList.add('ativo')
    })
    document.querySelector('.form_login').addEventListener('submit', function(e) {
        e.preventDefault()
        window.location.href = "inicio.html"
    })
}

/* Filtros */
const filtros = document.querySelectorAll('.filtro');
const cards = document.querySelectorAll('.card_produto');
const titulo = document.querySelector('.nossosprodutos');

filtros.forEach(function(botao) {
    botao.addEventListener('click', function() {
        filtros.forEach(function(b) { b.classList.remove('ativo'); });
        botao.classList.add('ativo');
        const categoriaSelecionada = botao.getAttribute('data-filtro');
        if (titulo) titulo.textContent = botao.textContent;
        cards.forEach(function(card) {
            if (card.getAttribute('data-categoria') === categoriaSelecionada) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

/* Navbar link ativo */
const links = document.querySelectorAll('.navbar nav a');
const paginaAtual = window.location.pathname.split('/').pop();
links.forEach(link => {
    if (link.getAttribute('href') === paginaAtual) {
        link.classList.add('ativo');
    }
});

/* Produtos */
const botoesComprar = document.querySelectorAll('.card_produto button');

if (botoesComprar.length > 0) {
    const fecharModal = document.getElementById('fechar-modal');
    if (fecharModal) {
        fecharModal.addEventListener('click', function() {
            document.getElementById('modal-compra').classList.remove('ativo');
        });
    }
    botoesComprar.forEach(function(botao) {
        botao.addEventListener('click', function() {
            const card = botao.closest('.card_produto');
            const produto = {
                nome: card.querySelector('h3').textContent,
                preco: card.querySelector('.preco').textContent,
                imagem: card.querySelector('img').src
            };
            const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
            carrinho.push(produto);
            localStorage.setItem('carrinho', JSON.stringify(carrinho));
           document.getElementById('modal-compra').classList.add('ativo');
        });
    });
}

/* Carrinho */
const listaCarrinho = document.querySelector('.lista-carrinho');

if (listaCarrinho) {
    let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
    const valoresEl = document.querySelector('.valores');
    const btnComprar = document.getElementById('btn-comprar');
    const valorPagar = document.querySelector('.valor-pagar');
    const valorPagarTotal = document.querySelector('.valor-pagar-total');
    let total = 0;

    function renderizarCarrinho() {
        listaCarrinho.innerHTML = '';
        valoresEl.innerHTML = '';
        total = 0;

        if (carrinho.length === 0) {
            listaCarrinho.innerHTML = '<p style="color: var(--text-muted)">Seu carrinho está vazio.</p>';
        } else {
            carrinho.forEach(function(produto, index) {
                listaCarrinho.innerHTML += `
                    <div class="card_produto">
                        <img src="${produto.imagem}" alt="${produto.nome}">
                        <h3>${produto.nome}</h3>
                        <span class="preco-item">${produto.preco}</span>
                        <button class="btn-remover" data-index="${index}">Remover</button>
                    </div>
                `;
                valoresEl.innerHTML += `
                    <p style="color: var(--text-muted); font-size: 0.85rem;">
                        ${produto.nome}: <span style="color: var(--accent)">${produto.preco}</span>
                    </p>
                `;
                const valor = parseFloat(
                    produto.preco.replace('R$', '').replace(',', '.').trim()
                );
                total += valor;
            });

            document.querySelector('.total-valor').textContent =
                'R$ ' + total.toFixed(2).replace('.', ',');

            document.querySelectorAll('.btn-remover').forEach(function(botao) {
                botao.addEventListener('click', function() {
                    const index = parseInt(botao.getAttribute('data-index'));
                    carrinho.splice(index, 1);
                    localStorage.setItem('carrinho', JSON.stringify(carrinho));
                    renderizarCarrinho();
                });
            });
        }
    }

    renderizarCarrinho();

    // exibe valor acumulado se já existir
    const valorSalvo = localStorage.getItem('valorPagar');
    if (valorSalvo) {
        valorPagarTotal.textContent = valorSalvo;
        valorPagar.style.display = 'block';
    }

    // botão comprar
    if (btnComprar) {
    btnComprar.addEventListener('click', function() {
        if (carrinho.length === 0) return;

        const valorAcumulado = parseFloat(
            (localStorage.getItem('valorPagar') || '0').replace('R$', '').replace(',', '.').trim()
        );
        const novoTotal = valorAcumulado + total;
        localStorage.setItem('valorPagar', 'R$ ' + novoTotal.toFixed(2).replace('.', ','));

        carrinho = [];
        localStorage.removeItem('carrinho');
        renderizarCarrinho();
        document.getElementById('modal-compra').classList.add('ativo');

        // recarrega automaticamente após 2 segundos
        setTimeout(function() {
            location.reload();
        }, 10000);
    });
}

    // fechar modal
    const fecharModal = document.getElementById('fechar-modal');
    if (fecharModal) {
        fecharModal.addEventListener('click', function() {
            document.getElementById('modal-compra').classList.remove('ativo');
        });
    }

    // Botão pagar
    const btnPagar = document.getElementById('btn-pagar');
    if (btnPagar) {
        btnPagar.addEventListener('click', function() {
            // zera o valor a pagar
            localStorage.removeItem('valorPagar');
            valorPagarTotal.textContent = '';
            valorPagar.style.display = 'none';

            // abre o modal
            document.getElementById('modal-pagar').classList.add('ativo');
        });
    }

    // fechar modal pagar
    const fecharModalPagar = document.getElementById('fechar-modal-pagar');
    if (fecharModalPagar) {
        fecharModalPagar.addEventListener('click', function() {
            document.getElementById('modal-pagar').classList.remove('ativo');
        });
    }
}


