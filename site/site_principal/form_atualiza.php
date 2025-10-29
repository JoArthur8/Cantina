<?php
    include '../pedaco.php';


?>

    <div class="container">
        <form action="atualiza.php?id=<?php echo $Cod_item; ?>" method="POST"> 
            <?php
                require '../conexao.php';
                $Cod_item = $_GET['id'];  
                $sql = "SELECT * FROM item WHERE Cod_item = $Cod_item";
                $stmt = $pdo->query($sql);
                $produto = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>

            <div class="mb-3">
                Nome: <input type="text" value="<?php echo $item['nome']; ?>" name="nome_novo" class="form-control">
            </div>
            <div class="mb-3">
                Preço: <input type="text" value="<?php echo $item['preco']; ?>" name="preco_novo" class="form-control">
            </div>
            <div class="mb-3">
                Quantidade: <input type="text" value="<?php echo $item['quantidade_estoque']; ?>" name="quantidade_novo" class="form-control">
            </div>
            <div class="mb-3">
                Tipo: <input type="text" value="<?php echo $item['Tipo']; ?>" name="tipo_novo" class="form-control">
            </div>
            <div class="mb-3">
                Descricao: <input type="text" value="<?php echo $item['Descricao']; ?>" name="descricao_nova" class="form-control">
            </div>
            
            <button type="submit" class="btn-custom">Atualizar</button>
        </form>
    </div>

</body>
</html>