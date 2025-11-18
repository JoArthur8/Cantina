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
