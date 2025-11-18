<?php
    session_start();    
    include_once 'conexao.php';
    
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];

    $e_email = filter_var($usuario, FILTER_VALIDATE_EMAIL) !== false;
    
    $_SESSION['login_tipo'] = $is_email ? 'email' : 'nome';

    $consulta = "SELECT * FROM usuario WHERE (Nome = :usuario OR Email = :usuario) AND Senha = :senha AND Cpf = :cpf ";
    
    $stmt = $pdo->prepare($consulta);
    
    // Vincula os parâmetros
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':cpf', $cpf);

    
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

        
         $tipo = $resultado['Tipo_Usuario'];

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
