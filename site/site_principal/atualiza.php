
<?php
    require 'conexao.php';

    $Cod_item = $_GET['Cod_item'];
    $nome_novo = $_POST['nome_novo'];
    $preco_novo = $_POST['preco_novo'];
    $quantidade_nova = $_POST['quantidade_nova'];
    $tipo_novo = $_POST['tipo_novo'];
    $descricao_nova = $_POST['descricao_nova'];
    $imagem_nova = $_POST['imagem_nova'];

    $sql = "UPDATE item SET Nome = :nome_novo, Descricao = :descricao_nova, Preco = :preco_novo, Tipo = :tipo_novo, Quantidade_Estoque = :quantidade_nova, Imagem = :imagem_nova WHERE Cod_item = :Cod_item";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':Cod_item', $Cod_item);
    $stmt->bindParam(':nome_novo', $nome_novo);
    $stmt->bindParam(':preco_novo', $preco_novo);
    $stmt->bindParam(':quantidade_novo', $quantidade_novo);


    if ($stmt->execute()) {
        // echo "Produto atualizado com sucesso!";
        header("location: listar.php");
    } else {
        echo "Erro ao atualizar produto.";
    }
    
?>