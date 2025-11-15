<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>CantinEtec</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>
<body class="index-page">
</body>
</html>

<?php
session_start();
require_once '../conexao.php';

$carrinho = $_SESSION['carrinho'] ?? [];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Carrinho</title>
<link href="assets/css/carrinhostyle.css" rel="stylesheet">
</head>

<body>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark custom-red">
    <div class="container-fluid">
      
      <!-- Links à esquerda -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="inicio.php">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="carrinho.php">Carrinho</a></li>
        <li class="nav-item"><a class="nav-link" href="deslogar.php">Sair</a></li>
      </ul>

      <!-- Nome do usuário à direita -->
      <span class="navbar-text ms-auto">
        <?php echo htmlspecialchars($_SESSION['nome']); ?>
      </span>

      <!-- Título também à direita -->
      <span class="navbar-text ms-3">
        <h1 class="h5 mb-0">Carrinho de Compras</h1>
      </span>

    </div>
  </nav>
</header>

<div class="container">

<?php if (empty($carrinho)): ?>
    <p>Seu carrinho está vazio.</p>

<?php else: ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Subtotal</th>
                <th>Ação</th>
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
                <td><?= $item['nome'] ?></td>
                <td><?= $item['qtd'] ?></td>
                <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                <td>
                    <form action="remover_carrinho.php" method="POST" style="display:inline;">
                        <input type="hidden" name="index" value="<?= $id ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total mb-3">
        <strong>Total: R$ <?= number_format($total, 2, ',', '.') ?></strong>
    </div>

    <!-- Formulário de pagamento -->
    <form action="finalizar_carrinho.php" method="POST">
        <div class="mb-3">
            <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
            <select class="form-select" id="forma_pagamento" name="forma_pagamento" required>
                <option value="">Selecione...</option>
                <option value="cartao_credito">Cartão de Crédito</option>
                <option value="cartao_debito">Cartão de Débito</option>
                <option value="pix">PIX</option>
                <option value="dinheiro">Dinheiro</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Finalizar Compra</button>
    </form>

<?php endif; ?>

</div>
</body>
</html>
