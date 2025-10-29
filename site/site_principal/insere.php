<?php
    require '../conexao.php';
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    $quantidade_estoque = $_POST['quantidade_estoque'];
    
    $sql = "INSERT INTO item (nome, preco, tipo, descricao, quantidade_estoque) VALUES (:nome, :preco, :tipo, :descricao, :quantidade_estoque )";
    
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':quantidade_estoque', $quantidade_estoque);
   
    if ($stmt->execute()) {
        echo "Produto inserido com sucesso!";
        header("location: diretor.php");
    } 
    else {
        echo "Erro ao inserir produto.";
    }
?>