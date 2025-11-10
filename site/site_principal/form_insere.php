<?php 
    include '../pedaco.php';
?> 
    <!-- Formulário de inserção de produto -->
    <div class="container">
        <form action="inserir.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3"> 
                <input type="text" class="form-control" name="nome" placeholder="Digite o nome do produto">
            </div>
            <div class="mb-3"> 
                <input type="text" class="form-control" name="preco" placeholder="Digite o preço do produto">
            </div>
            <div class="mb-3"> 
                <input type="text" class="form-control" name="quantidade" placeholder="Digite a quantidade em estoque do produto">
            </div>
            <div class="mb-3"> 
                <select name="tipo">
                    <option value="Doce">Doce</option>
                    <option value="Salgado">Salgado</option>
                    <option value="Bebida">Bebida</option>
                </select>
            </div>
            <div class="mb-3"> 
                <input type="text" class="form-control" name="descricao" placeholder="Digite a descrição do produto">
            </div>
            <div class="mb-3"> 
                <input type="file" class="form-control" name="imagem" accept="image/*"placeholder="arquivo de imagem do produto">
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
        </form>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>
</html>