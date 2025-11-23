<?php

session_start();
require_once '../conexao.php';

// Se não estiver logado, redireciona
if (!isset($_SESSION['nome'])) {
    header("Location: index.php");
    exit();
}

// Garante que o carrinho existe antes de limpar
if (isset($_SESSION['carrinho'])) {
  //   // Insere os dados da compra no banco de dados

  //   // Puxar dados da Session pro Cpf
  //   $Data_hora = date('d/m/Y H:i:s');
  //   $Cpf = $_POST['cpf'];


  //   $sql1 = "INSERT INTO pedido (Data_Hora, Usuario_Cpf) VALUES (:Data_Hora, :Usuario_Cpf)";

  //   $stmt = $pdo->prepare($sql1);

  //   $stmt->bindParam(':Data_hora', $Data_hora);
  //   $stmt->bindParam(':Cpf', $Cpf);

  // // Puxar dados da Session ou de carrinho.php   
  // // carrinho.php tem valor_total, Quantidade e Cod_item

  //   $Quantidade = $_POST['Quantidade'];
  //   $Pedido_Cod_pedido = $_POST['Pedido_Cod_pedido'];
  //   $Item_Cod_item = $_POST['Item_Cod_item'];
  //   $valor_total = $_POST['valor_total'];


  //   $sql2 = "INSERT INTO item_pedido (Quantidade, Pedido_Cod_pedido, Item_Cod_item, valor_total) VALUES (:Quantidade, :Pedido_Cod_pedido, :Item_Cod_item, :valor_total)";

  //   $stmt = $pdo->prepare($sql2);

  //   $stmt->bindParam(':Quantidade', $Quantidade);
  //   $stmt->bindParam(':Pedido_Cod_pedido', $Pedido_Cod_pedido);
  //   $stmt->bindParam(':Item_Cod_item', $Item_Cod_item);
  //   $stmt->bindParam(':valor_total', $valor_total
  // );

  //   if ($stmt->execute()) {
  //       header("location: carrinho.php");
  //   } else {
  //       echo "Erro ao fazer compra.";
  //   }

    unset($_SESSION['carrinho']);
}

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
