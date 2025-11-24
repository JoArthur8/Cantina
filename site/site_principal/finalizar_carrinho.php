<?php
session_start();
require_once '../conexao.php';

// Força horário correto
date_default_timezone_set('America/Sao_Paulo');
$pdo->exec("SET time_zone = '-03:00'");

// === VERIFICAÇÕES OBRIGATÓRIAS ===
if (!isset($_SESSION['nome'])) {
    header("Location: index.php");
    exit();
}

if (empty($_SESSION['carrinho'])) {
    die("Carrinho vazio.");
}

// === PEGA O CPF DO USUÁRIO LOGADO ===
if (!isset($_SESSION['cpf']) || empty(trim($_SESSION['cpf']))) {
    die("Erro: CPF não encontrado. Faça login novamente.");
}

$Cpf = trim($_SESSION['cpf']);

$carrinho = $_SESSION['carrinho'];

// Insere o pedido com NOW() e o CPF correto
$sql1 = "INSERT INTO pedido (Data_Hora, Usuario_Cpf) VALUES (NOW(), :Usuario_Cpf)";
$stmt1 = $pdo->prepare($sql1);
$stmt1->bindParam(':Usuario_Cpf', $Cpf);
$stmt1->execute();

$Pedido_Cod_pedido = $pdo->lastInsertId();

// Insere os itens
$sql2 = "INSERT INTO item_pedido (Quantidade, Pedido_Cod_pedido, Item_Cod_item, valor_total)
         VALUES (:Quantidade, :Pedido_Cod_pedido, :Item_Cod_item, :valor_total)";
$stmt2 = $pdo->prepare($sql2);

foreach ($carrinho as $id_item => $item) {
    $Quantidade  = $item['qtd'];
    $valor_total = $item['preco'] * $item['qtd'];

    $stmt2->bindParam(':Quantidade', $Quantidade);
    $stmt2->bindParam(':Pedido_Cod_pedido', $Pedido_Cod_pedido);
    $stmt2->bindParam(':Item_Cod_item', $id_item);
    $stmt2->bindParam(':valor_total', $valor_total);
    $stmt2->execute();
}

unset($_SESSION['carrinho']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Compra Finalizada</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <script>
    // Redireciona após 3 segundos
    setTimeout(function() {
      window.location.href = "inicio.php";
    }, 3000);
  </script>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

  <div class="text-center">
    <h1 class="text-success">Obrigado pela sua compra!</h1>
    <p>Você será redirecionado para a página inicial em alguns segundos...</p>
    <div class="spinner-border text-success mt-3" role="status">
      <span class="visually-hidden">Carregando...</span>
    </div>
  </div>

</body>
</html>
