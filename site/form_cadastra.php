<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cadastro</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Background Video-->
    <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="assets/mp4/cozinhar.mp4" type="video/mp4" />
    </video>
    <!-- Masthead-->
    <div class="masthead">
        <div class="masthead-content text-white">
            <div class="container-fluid px-4 px-lg-0">
                <h1 class="fst-italic lh-1 mb-4">Crie sua Conta:</h1>
                <p class="mb-5">Preencha os campos abaixo para criar sua conta e acessar o sistema.</p>
                <form action="contas.php" method="POST">
                    <div class="mb-3"> 
                        <input type="text" class="form-control" name="nome_usuario" placeholder="Digite o seu nome de usuário">
                    </div>
                    <div class="mb-3"> 
                        <input type="password" class="form-control" name="senha" placeholder="Digite a sua senha">
                    </div>
                    <div class="mb-3"> 
                        <!-- Fazer depois seleção de Tipo -->            
                        Tipo: <select name="tipo">
                            <option value="0">Consumidor</option>
                            <option value="1">Diretor de Cantina</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <a href="index.php" type="button" class="btn btn-danger">Voltar</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>