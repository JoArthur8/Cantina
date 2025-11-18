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

    // Insere os dados na tabela usuario
    $sql = "INSERT INTO usuario (CPF, Nome, Email, Senha, Tipo_Usuario) VALUES ('$cpf', '$nome', '$email', '$senha', '$tipo')";

    // Executa a query e verifica se foi bem-sucedida
    $rs = mysqli_query($con, $sql);
    if($rs){
        // Cria a sessão de login automaticamente
        $_SESSION['cpf'] = $cpf;
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['tipo'] = $tipo;

        // Limpa os dados de cadastro da sessão
        unset($_SESSION['dados_cadastro']);

        // Redireciona para a área de login
        header("Location: login.php");
        exit;
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($con);
    }
?>
