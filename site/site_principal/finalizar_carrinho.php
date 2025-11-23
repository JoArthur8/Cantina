<?php
session_start();
require_once '../conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['nome'])) {
    header("Location: index.php");
    exit();
}

// Verifica se o carrinho não está vazio
if (empty($_SESSION['carrinho'])) {
    die("Carrinho vazio.");
}

// Dados do carrinho
$carrinho = $_SESSION['carrinho'];

// Dados do usuário
$Cpf = $_SESSION['cpf']; 

$Data_Hora = date('Y-m-d H:i:s');

// INSERIR O PEDIDO
$sql1 = "INSERT INTO pedido (Data_Hora, Usuario_Cpf)
         VALUES (:Data_Hora, :Usuario_Cpf)";
    
$stmt1 = $pdo->prepare($sql1);
$stmt1->bindParam(':Data_Hora', $Data_Hora);
$stmt1->bindParam(':Usuario_Cpf', $Cpf);
$stmt1->execute();

// ID do pedido recém criado
$Pedido_Cod_pedido = $pdo->lastInsertId();

// INSERIR ITENS DO PEDIDO
$sql2 = "INSERT INTO item_pedido 
        (Quantidade, Pedido_Cod_pedido, Item_Cod_item, valor_total)
         VALUES (:Quantidade, :Pedido_Cod_pedido, :Item_Cod_item, :valor_total)";

$stmt2 = $pdo->prepare($sql2);

// Loop pelos itens do carrinho
foreach ($carrinho as $id_item => $item) {

    $Quantidade = $item['qtd'];
    $valor_total = $item['preco'] * $item['qtd'];

    $stmt2->bindParam(':Quantidade', $Quantidade);
    $stmt2->bindParam(':Pedido_Cod_pedido', $Pedido_Cod_pedido);
    $stmt2->bindParam(':Item_Cod_item', $id_item);
    $stmt2->bindParam(':valor_total', $valor_total);

    $stmt2->execute();
}

// Limpa o carrinho após finalizar a compra
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
