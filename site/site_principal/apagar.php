<?php
    require '../conexao.php';
    $Cod_item = $_GET['id'];
    $sql = "DELETE FROM item WHERE Cod_item = :Cod_item";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':Cod_item', $Cod_item);
    if ($stmt->execute()) {
        echo "Produto excluído com sucesso!";
        header("location: diretor.php");
    } else {
        echo "Erro ao excluir produto.";
    }
?>