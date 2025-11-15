<?php
session_start();

if (isset($_POST['index'])) {
    $index = $_POST['index'];

    if (isset($_SESSION['carrinho'][$index])) {
        unset($_SESSION['carrinho'][$index]);
        // Reindexa o array para evitar buracos: 0,1,2...
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
    }
}

header("Location: carrinho.php");
exit;
?>