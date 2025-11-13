<?php
    include '../pedaco.php';
?>

    <div class="container">
        <form action="atualiza.php?id=<?php echo $Cod_item; ?>" method="POST"> 
        <?php
            require '../conexao.php';
            $Cod_item = $_GET['Cod_item'];
            // $id = str_replace("type=","", $id);
            $sql = "SELECT * FROM item WHERE Cod_item = $Cod_item";
            $stmt = $pdo->query($sql);
            $Item = $stmt->fetch(PDO::FETCH_ASSOC);

        ?>  
            <div class="mb-3">
                Nome: <input type="text" value="<?php echo $Item['Nome']; ?>" name="nome_novo" class="form-control">
            </div>
            <div class="mb-3">
                Preço: <input type="text" value="<?php echo $Item['Preco']; ?>" name="preco_novo" class="form-control">
            </div>

            <div class="mb-3">
                Quantidade: <input type="text" value="<?php echo $Item['Quantidade_Estoque']; ?>" name="quantidade_nova" class="form-control">
            </div>
            <div class="mb-3">
                Tipo: <input type="text" value="<?php echo $Item['Tipo']; ?>" name="tipo_novo" class="form-control">
            </div>
            <div class="mb-3">
                Descrição: <input type="text" value="<?php echo $Item['Descricao']; ?>" name="descricao_nova" class="form-control">
            </div>
            <div class="mb-3">
                Imagem: <input type="file" value="<?php echo $Item['Imagem']; ?>" name="imagem_nova" class="form-control">
            </div>

            <a name="btn-atualiza" class="btn btn-danger" href='atualiza.php'>ATUALIZAR</a>
            <?php 
                if (isset($_POST['btn-atualiza'])){
                    echo 'teste';
                    header('location: diretor.php');
                }
            ?>
        </form>
    </div>

</body>
</html>