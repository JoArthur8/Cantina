<?php
session_start();
   require 'conexao.php';

    if((!isset($_SESSION['cpf'])) and (!isset($_SESSION['nome'])) and (!isset($_SESSION['tipo'])) ){
        unset(
            $_SESSION['cpf'],
            $_SESSION['nome'],
            $_SESSION['tipo']

        );
        header('location: ../index.php');
    }
?>

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
  
    <!-- Link nosso CSS -->
 
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename">CantinEtec</h1><span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <!-- Verifica o tipo de usuário para exibir a navbar correta -->
          <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'administrador'): ?>
            <!-- Navbar do ADMIN -->
            <li><a href="diretor.php">Painel</a></li>
            <li><a href="inicio.php">Cardápio</a></li>
            <li><a href="./carrinho.php">Carrinho</a></li>
            <li><a href="deslogar.php">Sair</a></li>
            
          <?php else: ?>
            <!-- Navbar normal -->
            <li><a href="#hero" class="active">Início</a></li>
            <li><a href="#menu">Cardápio</a></li>
            <li><a href="./carrinho.php">Carrinho</a></li>
            <li><a class="nav-link" href="deslogar.php">Sair</a></li>
          <?php endif; ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <!-- Nome do usuário alinhado à direita -->
      <span class="navbar-text ms-0 fw-semibold d-none d-xl-inline mb-1">
        <?php echo isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : ''; ?>
      </span>
    </div>
  </header>
