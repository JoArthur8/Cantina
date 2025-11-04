<?php
    require '../conexao.php';
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];

    $sql = "INSERT INTO Item (Nome, Preco, Quantidade_Estoque, Descricao, Tipo) VALUES (:nome, :preco, :quantidade, :descricao, :tipo)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':tipo', $tipo);

    if ($stmt->execute()) {
        header("location: diretor.php");
    } else {
        echo "Erro ao inserir produto.";
    }
?>