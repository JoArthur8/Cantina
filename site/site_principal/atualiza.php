<?php
    require '../conexao.php';

    // Pegando o ID do item
    $Cod_item = $_GET['Cod_item'] ?? null;

    // Se não receber o ID, cancela
    if (!$Cod_item) {
        die("ID do item não fornecido.");
    }

    // Pegando os dados do formulário
    $nome_novo = $_POST['nome_novo'] ?? null;
    $preco_novo = $_POST['preco_novo'] ?? null;
    $quantidade_nova = $_POST['quantidade_nova'] ?? null;
    $tipo_novo = $_POST['tipo_novo'] ?? null;
    $descricao_nova = $_POST['descricao_nova'] ?? null;

    // Pega imagem antiga do banco (caso não envie imagem nova)
    $sqlOld = "SELECT Imagem FROM item WHERE Cod_item = :Cod_item";
    $stmtOld = $pdo->prepare($sqlOld);
    $stmtOld->bindParam(':Cod_item', $Cod_item);
    $stmtOld->execute();
    $ItemAntigo = $stmtOld->fetch(PDO::FETCH_ASSOC);

    $imagem_antiga = $ItemAntigo['Imagem'];

    // Processa a imagem nova, se houver
    $imagem_final = $imagem_antiga; // começa assumindo que não trocou

    if (isset($_FILES['imagem_nova']) && $_FILES['imagem_nova']['error'] === 0) {

        $pasta = "assets/img/menu/";
        $nomeArquivo = basename($_FILES['imagem_nova']['name']);
        $caminhoDestino = $pasta . $nomeArquivo;

        // mover arquivo
        if (move_uploaded_file($_FILES['imagem_nova']['tmp_name'], $caminhoDestino)) {
            $imagem_final = $caminhoDestino; // nova imagem salva
        } else {
            echo "Erro ao enviar nova imagem. Mantendo a antiga.<br>";
        }
    }

    // Atualiza no banco
    $sql = "UPDATE item 
            SET Nome = :nome_novo,
                Preco = :preco_novo,
                Quantidade_Estoque = :quantidade_nova,
                Descricao = :descricao_nova,
                Tipo = :tipo_novo,
                Imagem = :imagem_nova
            WHERE Cod_item = :Cod_item";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':Cod_item', $Cod_item);
    $stmt->bindParam(':nome_novo', $nome_novo);
    $stmt->bindParam(':preco_novo', $preco_novo);
    $stmt->bindParam(':quantidade_nova', $quantidade_nova);
    $stmt->bindParam(':descricao_nova', $descricao_nova);
    $stmt->bindParam(':tipo_novo', $tipo_novo);
    $stmt->bindParam(':imagem_nova', $imagem_final);

    // Executar
    if ($stmt->execute()) {
        header("location: diretor.php");
        exit;
    } else {
        echo "Erro ao atualizar produto.";
    }
?>
