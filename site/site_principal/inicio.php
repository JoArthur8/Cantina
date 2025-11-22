<?php include '../pedaco.php'; ?>
<?php include '../conexao.php'; ?>
<head>
  <link rel="stylesheet" href="../estilo.css">
</head>


<body class="index-page">

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">
      <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-between">
          <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Aproveite a sua<br>Comida Deliciosa</h1>
            <p data-aos="fade-up" data-aos-delay="100" class="text-center">Compre e aproveite!</p>
          </div>
          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>
    </section>
    <!-- /Hero Section -->

    <!-- Menu Section -->
    <section id="menu" class="menu section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Nosso Cardápio</h2>
        <p><span>Cheque o nosso</span> <span class="description-title">CantinEtec Cardápio</span></p>
      </div>

      <div class="container">
        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
          <div class="tab-pane fade active show" id="menu-starters">

            <div class="tab-header text-center">
              <h3>Menu</h3>
            </div>

            <div class="row gy-5">

              <?php
                try {
                    $sql = "SELECT Cod_item, Nome, Preco, Descricao, Imagem FROM Item";
                    $stmt = $pdo->query($sql);

                    if ($stmt->rowCount() > 0) {
                        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            // imagem padrão se estiver vazia
                            $temImagem = !empty($item['Imagem']);
                            $imagem = $temImagem ? htmlspecialchars($item['Imagem']) : 'assets/img/sem-imagem.png';

                            // se tiver imagem real = glightbox
                            if ($temImagem) {
                                $imgTag = '
                                <a href="' . $imagem . '" class="glightbox">
                                    <img src="' . $imagem . '" class="menu-img img-fluid" alt="">
                                </a>';
                            } else {
                                $imgTag = '
                                <img src="' . $imagem . '" class="menu-img img-fluid" alt="">';
                            }

                            // card final
                            echo '
                            <div class="col-lg-4 menu-item">
                              ' . $imgTag . '
                              <h4>' . htmlspecialchars($item['Nome']) . '</h4>
                              <p class="ingredients">' . htmlspecialchars($item['Descricao']) . '</p>
                              <p class="price">R$' . number_format($item['Preco'], 2, ',', '.') . '</p>

                              <button type="button" class="btn btn-primary btn-add-cart"
                                      data-bs-toggle="modal"
                                      data-bs-target="#quantModal"
                                      data-itemid="' . (int)$item['Cod_item'] . '"
                                      data-itemname="' . htmlspecialchars($item['Nome'], ENT_QUOTES) . '"
                                      data-itemprice="' . number_format($item['Preco'], 2, '.', '') . '">
                                Adicionar ao carrinho
                              </button>
                            </div>';
                        }
                    } else {
                        echo '<p class="text-center">Nenhum item no cardápio ainda 😢</p>';
                    }

                } catch (PDOException $e) {
                    echo '<p class="text-danger">Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
                }
              ?>

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Menu Section -->
    <!-- Contato / Desenvolvedores -->
    <section class="text-center" id="Contato">
      <h2 class="text-black mb-4">Desenvolvedores</h2>
      <div class="container text-center">

        <div class="row">
          <div class="col">
            <img class="sobreimg" src="assets/img/Joao.png" alt="">
            <h4 class="text-black">João Arthur</h4>
          </div>
          <div class="col">
            <img class="sobreimg" src="assets/img/Dudu.jpeg" alt="">
            <h4 class="text-black">Eduardo Luiz</h4>
          </div>
          <div class="col">
            <img class="sobreimg" src="assets/img/arthur.jpg" alt="">
            <h4 class="text-black">Arthur Luz</h4>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <img class="sobreimg2" src="assets/img/guilherme.jpg" alt="">
            <h4 class="text-black">Guilherme Gimenes</h4>
          </div>
          <div class="col">
            <img class="sobreimg2" src="assets/img/sem-imagem.png" alt="">
            <h4 class="text-black">Caio Oliveira</h4>
          </div>
        </div>

      </div>

      <h2 class="text-black mb-4">Professores</h2>
      <div class="container text-center">
        <div class="row">
          <div class="col">
            <img class="sobreimg" src="assets/img/cintia.jpg" alt="">
            <h3 class="text-black">Cíntia Pinho</h3>
          </div>
          <div class="col">
            <img class="sobreimg" src="assets/img/Anderson.jpg" alt="">
            <h3 class="text-black">Anderson Vanin</h3>
          </div>
        </div>
      </div>
    </section>

    <div class="modal fade" id="quantModal" tabindex="-1" aria-labelledby="quantModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
          <form action="adicionar_carrinho.php" method="POST" id="modalAddForm">
            <div class="modal-header">
              <h5 class="modal-title" id="quantModalLabel">Adicionar ao carrinho</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
              <p id="modalItemInfo"></p>
              <input type="hidden" name="Cod_item" id="modalCodItem" value="">
              <div class="mb-3">
                <label for="modalQtd" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="modalQtd" name="qtd" value="1" min="1" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
      <i class="bi bi-arrow-up-short"></i>
    </a>

    <div id="preloader"></div>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/modal.js"></script>

</body>
</html>
