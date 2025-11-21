<?php
    session_start();
    require 'conexao.php';

    // Verifica se os dados foram enviados via sessão
    if (!isset($_SESSION['dados_cadastro'])) {
        die("Nenhum dado recebido.");
    } 

    // Recupera os dados da sessão
    $dados = $_SESSION['dados_cadastro'];

    // Extrai os dados
    $cpf = $dados['cpf'];
    $nome = $dados['nome'];
    $senha = $dados['senha'];
    $tipo = $dados['tipo'];
    $email = $dados['email'];




    // Conexão com o banco e o INSERT
    $con = mysqli_connect($host, $user, $pass, $dbname);
    if(!$con){
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }
    
    // Verifica duplicados por CPF ou Email
    $stmt = mysqli_prepare($con, "SELECT CPF, Email FROM usuario WHERE CPF = ? OR Email = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "ss", $cpf, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $cpf_exist, $email_exist);
    $exists = mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($exists) {
        $msg = [];
        if (!empty($cpf_exist)) $msg[] = "CPF já cadastrado.";
        if (!empty($email_exist)) $msg[] = "Email já cadastrado.";
        $_SESSION['erro_cadastro'] = implode(' ', $msg);
        // mantém os dados para reapresentação
        header("Location: form_cadastra.php");
        exit;
    }


    // Insere com prepared statement
    $insert = mysqli_prepare($con, "INSERT INTO usuario (CPF, Nome, Email, Senha, Tipo_Usuario) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($insert, "sssss", $cpf, $nome, $email, $senha, $tipo);

    if (mysqli_stmt_execute($insert)) {
        // auto-login opcional
        $_SESSION['cpf'] = $cpf;
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['tipo'] = $tipo;

        unset($_SESSION['dados_cadastro']);
        mysqli_stmt_close($insert);
        mysqli_close($con);
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['erro_cadastro'] = "Erro ao cadastrar: " . mysqli_error($con);
        mysqli_stmt_close($insert);
        mysqli_close($con);
        header("Location: form_cadastra.php");
        exit;
    }
?>
