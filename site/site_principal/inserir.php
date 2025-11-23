<?php
    require '../conexao.php';
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $pasta = "assets/img/menu/"; // Pasta onde a imagem será salva

    // Processa o upload da imagem
    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $nomeArquivo = basename($_FILES['imagem']['name']);
        $caminhoDestino = $pasta . $nomeArquivo;
        // Move o arquivo enviado para a pasta de destino
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
            
            $imagem = $caminhoDestino; // Caminho da imagem salva
        } else {
            echo "Erro ao fazer upload da imagem.";
        }
    }

    $sql = "INSERT INTO Item (Nome, Preco, Quantidade_Estoque, Descricao, Tipo, Imagem) VALUES (:nome, :preco, :quantidade, :descricao, :tipo, :imagem)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':imagem', $imagem);

    if ($stmt->execute()) {
        header("location: diretor.php");
    } else {
        echo "Erro ao inserir produto.";
    }
?>