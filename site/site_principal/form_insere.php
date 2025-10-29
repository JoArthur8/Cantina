<?php
    include '../pedaco.php';
?>
<div class="container">
    <form action="insere.php" method="POST">
        <div class="mb-3">
            <input type="text" name="nome" placeholder="Digite o nome do produto:" class="form-control">
        </div>
        <div class="mb-3">
            <input type="text" name="preco" placeholder="Digite o preço do produto:" class="form-control">
        </div>
        <div class="mb-3">
            <input type="text" name="tipo" placeholder="Digite o tipo do produto:" class="form-control">
        </div>
        <div class="mb-3">
            <input type="text" name="descricao" placeholder="Digite a descrição do produto:" class="form-control">
        </div>
        <div class="mb-3">
            <input type="text" name="quantidade_estoque" placeholder="Digite a quantidade do produto:" class="form-control">
        </div>

        <button type="submit" class="btn-custom">Adicionar</button>
    </form>
</div>