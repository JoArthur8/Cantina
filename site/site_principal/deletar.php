<?php
    require '../conexao.php';
    $Cod_item = $_GET['Cod_item'];
    $sql = "DELETE FROM Item WHERE Cod_item = :Cod_item";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':Cod_item', $Cod_item);
    if ($stmt->execute()) {
        header("location: diretor.php");
    } else {
        echo "Erro ao excluir produto.";
}
?>