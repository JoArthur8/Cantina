<?php
    session_start();    
    include_once 'conexao.php';
    
    $nome = $_POST['nome_usuario'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $tipo = $_POST['tipo'];
    
    $consulta = "SELECT * FROM usuario WHERE Nome = :nome_usuario AND Senha = :senha AND Cpf = :cpf AND Tipo_usuario = :tipo";
    
    $stmt = $pdo->prepare($consulta);
    
    // Vincula os parâmetros
    $stmt->bindParam(':nome_usuario', $nome);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':tipo', $tipo);
    
    // Executa a consulta
    $stmt->execute();

    // Obtém o número de registros encontrados
    $registros = $stmt->rowCount();
    
    // Obtém o resultado
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);


    
    if($registros == 1){
        $_SESSION['cpf'] = $resultado['Cpf'];
        $_SESSION['nome'] = $resultado['Nome'];
        $_SESSION['tipo'] = $resultado['Tipo_Usuario'];

        if ($tipo == 'administrador'){
            header('Location: site_principal/diretor.php');
        } if ($tipo == 'consumidor'){
            header('Location: site_principal/inicio.php');
        }

     }else{      
        $_SESSION['erro_login'] = "Login inválido! Verifique suas informações e tente novamente.";
        header('Location: login.php');
        exit;
    }
?>
