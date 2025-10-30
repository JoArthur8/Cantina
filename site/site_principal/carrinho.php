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

        <?php
            require 'conexao.php';

            $sql = "SELECT * FROM item_pedido";
            $stmt = $pdo->query($sql);

            while ($item_pedido = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                    echo "<td>" . $item_pedido['Quantidade'] . "</td>";
                    echo "<td>" . $item_pedido['Pedido_Cod_pedido'] . "</td>";
                    echo "<td>" . $item_pedido['Item_Cod_Item'] . "</td>";
                    echo "<td>" . $item_pedido['valor_total'] . "</td>";
                    /* echo "
                    <td>
                        <div class='btn-group' role='group'>
                            <a href='form_atualiza.php?id=" . $produto['id'] . "' type='button' class='btn btn-danger'>ATUALIZAR</a>
                            <a href='apagar.php?id=" . $produto['id'] . "' type='button' class='btn btn-warning botaoapagar'>APAGAR</a>
                        </div>
                    </td>
                    "; */
                echo "</tr>";
            }
        ?>

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
