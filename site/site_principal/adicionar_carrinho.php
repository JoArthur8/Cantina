<?php
session_start();
require_once '../conexao.php';

$id = intval($_POST['id']);

// Buscar item no banco via PDO
$stmt = $pdo->prepare("SELECT * FROM item WHERE Cod_item = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("Item não encontrado!");
}

// Criar carrinho caso não exista
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Se o item já estiver no carrinho, só aumenta a quantidade
if (isset($_SESSION['carrinho'][$id])) {
    $_SESSION['carrinho'][$id]['qtd']++;
} else {
    $_SESSION['carrinho'][$id] = [
        'nome' => $item['Nome'],
        'preco' => $item['Preco'],
        'qtd' => 1
    ];
}

header("Location: carrinho.php");
exit();
?>