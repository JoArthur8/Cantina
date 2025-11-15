<?php include '../pedaco.php'; ?>

<body class="index-page">

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-between">
          <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Aproveite a sua<br>Comida Deliciosa</h1>
            <p data-aos="fade-up" data-aos-delay="100">Compre e aproveite!</p>
          </div>
          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <?php
require_once '../conexao.php';

// Busca os itens
$stmt = $pdo->prepare("SELECT * FROM item");
$stmt->execute();
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section id="Menu" class="menu">
  <div class="container">
    <div class="section-title">
      <h2>Cardápio</h2>
    </div>

    <div class="row gy-4">
      <?php foreach ($itens as $item): ?>
        <?php
          // monta a tag de imagem de forma segura
          $imgSrc = htmlspecialchars($item['Imagem'] ?? '');
          $imgTag = $imgSrc ? '<img src="' . $imgSrc . '" alt="' . htmlspecialchars($item['Nome']) . '" class="menu-img img-fluid">' : '';
        ?>

        <div class="col-lg-4 menu-item">
          <?= $imgTag ?>

          <h4><?= htmlspecialchars($item['Nome']) ?></h4>
          <p class="ingredients"><?= htmlspecialchars($item['Descricao']) ?></p>
          <p class="price">R$<?= number_format($item['Preco'], 2, ',', '.') ?></p>

          <form action="adicionar_carrinho.php" method="POST">
            <input type="hidden" name="id" value="<?= (int)$item['Cod_item'] ?>">
            <button type="submit" class="btn btn-primary">Adicionar ao carrinho</button>
          </form>
        </div>

      <?php endforeach; ?>
    </div>
  </div>
</section>


    </section><!-- /Menu Section -->
    <section class="text-center" id="Contato">
      <h2 class="text-black mb-4">Desenvolvedores</h2>
      <div class="container text-center">
        <div class="row">
          <div class="col">

            <img class="sobreimg" src="assets/img/Joao.PNG" alt="">
            <p class="text-black">João Arthur</p>
          </div>
          <div class="col">

            <img class="sobreimg" src="assets/img/Dudu.jpeg" alt="">
            <p class="text-black">Eduardo Luiz</p>
          </div>
          <div class="col">

            <img class="sobreimg" src="assets/img/euarthur (1).jpg" alt="">
            <p class="text-black">Arthur Luz</p>
          </div>
        </div>
        <div class="row">
          <div class="col">

            <img class="sobreimg" src="assets/img/guilherme.jfif" alt="">
            <p class="text-black">Guilherme Gimenes</p>
          </div>
          <div class="col">

            <img class="sobreimg" src="assets/img/thiago.jfif" alt="">
            <p class="text-black">Caio Oliveira</p>
          </div>
        </div>
      </div>
      <h2 class="text-black mb-4">Professores</h2>
      <div class="container text-center">
        <div class="row">
          <div class="col">

            <img class="sobreimg2" src="assets/img/cintia.jpg" alt="">
            <p class="text-black">Cíntia Pinho</p>
          </div>
          <div class="col">

            <img class="sobreimg2" src="assets/img/amanda.jpg" alt="">
            <p class="text-black">Anderson Vanin</p>
          </div>
        </div>
      </div>
    </section>
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>