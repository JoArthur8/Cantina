<?php
    require '../conexao.php';
    
    $Cod_item = $_GET['id'];
    $nome_novo = $_POST['nome_novo'];
    $preco_novo = $_POST['preco_novo'];
    $quantidade_novo = $_POST['quantidade_novo'];
    $tipo_novo = $_POST['tipo_novo'];
    $descricao_nova = $_POST['descricao_nova'];

    $sql = "UPDATE produtos SET nome = :nome_novo, preco = :preco_novo, quantidade = :quantidade_novo, tipo = :tipo_novo, descricao = :descricao_nova WHERE cod_item = :cod_item";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome_novo', $nome_novo);
    $stmt->bindParam(':preco_novo', $preco_novo);
    $stmt->bindParam(':quantidade_novo', $quantidade_novo);
    $stmt->bindParam(':preco_novo', $preco_novo);
    $stmt->bindParam(':descricao_nova', $descricao_nova);

    
    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso!";
        header("location: diretor.php");
    } else {
        echo "Erro ao atualizar produto.";
    }
?>