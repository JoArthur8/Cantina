<?php
session_start();
require_once '../conexao.php';

$carrinho = $_SESSION['carrinho'] ?? [];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CantinEtec - Carrinho</title>

  <!-- Bootstrap -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Estilos -->
  <link href="assets/css/carrinhostyle.css" rel="stylesheet">
</head>

<body>

<header>
    <nav class="navbar navbar-dark custom-red py-2">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <!-- LADO ESQUERDO: seta -->
            <div class="d-flex align-items-center">
                <a href="inicio.php" class="back-btn">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <!-- CENTRO: título -->
            <div class="flex-grow-1 text-center">
                <span class="titulo-carrinho">Carrinho</span>
            </div>

            <!-- DIREITA: nome -->
            <div class="nome-usuario text-end">
                <?= htmlspecialchars($_SESSION['nome']); ?>
            </div>

        </div>
    </nav>
</header>


<div class="container mt-4">

<?php if (empty($carrinho)): ?>
    <div class="alert alert-warning text-center">
        Seu carrinho está vazio.
    </div>

<?php else: ?>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-danger">
                <tr>
                    <th>Produto</th>
                    <th class="text-center">Qtd</th>
                    <th>Preço</th>
                    <th>Subtotal</th>
                    <th class="text-center">Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $total = 0;
            foreach ($carrinho as $id => $item):
                $subtotal = $item['preco'] * $item['qtd'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($item['nome']); ?></td>
                    <td class="text-center"><?= $item['qtd']; ?></td>
                    <td>R$ <?= number_format($item['preco'], 2, ',', '.'); ?></td>
                    <td>R$ <?= number_format($subtotal, 2, ',', '.'); ?></td>
                    <td class="text-center">
                        <form action="remover_carrinho.php" method="POST" class="d-inline">
                            <input type="hidden" name="index" value="<?= $id ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Total -->
    <div class="text-end fs-5 fw-semibold mt-3">
        Total: R$ <?= number_format($total, 2, ',', '.'); ?>
    </div>

    <!-- Pagamento -->
    <form action="finalizar_carrinho.php" method="POST" class="mt-4">
        <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
        <select class="form-select shadow-sm" id="forma_pagamento" name="forma_pagamento" required>
            <option value="">Selecione...</option>
            <option value="cartao_credito">Cartão de Crédito</option>
            <option value="cartao_debito">Cartão de Débito</option>
            <option value="pix">PIX</option>
            <option value="dinheiro">Dinheiro</option>
        </select>

        <button type="submit" class="btn btn-success mt-3 w-100 py-2 shadow-sm">
            Finalizar Compra
            <?php

                $Quantidade =  $item['qtd'];
                $Pedido_Cod_pedido = $pedido['Cod_pedido'];
                $Item_Cod_pedido = $item['Cod_item'];
                $valor_total = $total;
                
            
                $sql = "INSERT INTO item_pedido (Quantidade, Pedido_Cod_pedido, Item_Cod_pedido, valor_total) VALUES (:Quantidade, :Pedido_Cod_pedido, :Item_Cod_pedido, :valor_total)";
                
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':Quantidade', $Quantidade);
                $stmt->bindParam(':Pedido_Cod_pedido', $Pedido_Cod_pedido);
                $stmt->bindParam(':Item_Cod_pedido', $Item_Cod_pedido);
                $stmt->bindParam(':valor_total', $valor_total);
            
                $stmt->execute()
            ?>
        </button>
    </form>

<?php endif; ?>

</div>

</body>
</html>
