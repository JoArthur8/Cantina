<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - CantinEtec</title>
    <link href="assets/css/carrinhostyle.css" rel="stylesheet">
</head>
<body>

<header>
    <h1>Carrinho de Compras</h1>
</header>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody id="cart-items">
            <!-- Os itens do carrinho vão ser inseridos aqui -->
        </tbody>
    </table>

    <div class="total">
        Total: R$ <span id="total-price">0.00</span>
    </div>

    <div class="payment">
        <label for="payment-method">Forma de Pagamento:</label>
        <select id="payment-method">
            <option value="dinheiro">Dinheiro</option>
            <option value="cartao">Cartão de Crédito/Débito</option>
            <option value="pix">PIX</option>
        </select>
    </div>

    <button class="btn" onclick="finalizarCompra()">Finalizar Compra</button>
</div>

<script>
    // só pro carrinho não ficar vazio (ai é só trocar ou tirar depois)
    const carrinho = [
        {nome: "Hambúrguer", quantidade: 2, preco: 12.50},
        {nome: "Suco Natural", quantidade: 1, preco: 5.00},
        {nome: "Batata Frita", quantidade: 3, preco: 8.00}
    ];

    function atualizarCarrinho() {
        const tbody = document.getElementById("cart-items");
        tbody.innerHTML = "";
        let total = 0;

        carrinho.forEach(item => {
            const subtotal = item.quantidade * item.preco;
            total += subtotal;

            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${item.nome}</td>
                <td>${item.quantidade}</td>
                <td>R$ ${item.preco.toFixed(2)}</td>
                <td>R$ ${subtotal.toFixed(2)}</td>
            `;
            tbody.appendChild(tr);
        });

        document.getElementById("total-price").innerText = total.toFixed(2);
    }

    function finalizarCompra() {
        const formaPagamento = document.getElementById("payment-method").value;
        alert(`Compra finalizada!\nForma de pagamento: ${formaPagamento}\nTotal: R$ ${document.getElementById("total-price").innerText}`);
        // Um alert só pra encher linguiça mesmo
    }

    // Inicia a função
    atualizarCarrinho();
</script>

</body>
</html>
