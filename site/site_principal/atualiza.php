<?php
    require '../conexao.php';
    
    $Cod_item = $_GET['Cod_item'];
    $nome_novo = $_POST['nome_novo'];
    $preco_novo = $_POST['preco_novo'];
    $quantidade_novo = $_POST['quantidade_novo'];
    $tipo_novo = $_POST['tipo_novo'];
    $descricao_nova = $_POST['descricao_nova'];

    $sql = "UPDATE item SET Nome = :nome_novo, Descricao = :descricao_nova, Preco = :preco_novo, Tipo = :tipo_novo, Quantidade_Estoque = :quantidade_novo  WHERE id = :Cod_item";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':Cod_item', $Cod_item);
    $stmt->bindParam(':Nome_novo', $nome_novo);
    $stmt->bindParam(':Preco_novo', $preco_novo);
    $stmt->bindParam(':Quantidade_novo', $quantidade_novo);
    $stmt->bindParam(':Preco_novo', $preco_novo);
    $stmt->bindParam(':Descricao_nova', $descricao_nova);

    
    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso!";
        header("location: index.php");
    } else {
        echo "Erro ao atualizar produto.";
    }
?>