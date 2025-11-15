<?php
    session_start();
    require_once '../conexao.php';

    $Cod_item = intval($_POST['Cod_item']);

    // Buscar item no banco via PDO
    $stmt = $pdo->prepare("SELECT * FROM item WHERE Cod_item = ?");
    $stmt->execute([$Cod_item]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        die("Item não encontrado!");
    }

    // Criar carrinho caso não exista
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Se o item já estiver no carrinho, só aumenta a quantidade
    if (isset($_SESSION['carrinho'][$Cod_item])) {
        $_SESSION['carrinho'][$Cod_item]['qtd']++;
    } else {
        $_SESSION['carrinho'][$Cod_item] = [
            'nome' => $item['Nome'],
            'preco' => $item['Preco'],
            'qtd' => 1
        ];
    }

    header("Location: carrinho.php");
    exit();
?>