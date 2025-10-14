<?php 
    include 'pedaco.php';
?> 

    <div class="container">
        <form action="contas.php" method="POST">
            <div class="mb-3"> 
                <input type="text" class="form-control" name="nome_usuario" placeholder="Digite o seu nome de usuário">
            </div>
            <div class="mb-3"> 
                <input type="password" class="form-control" name="senha" placeholder="Digite a sua senha">
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>
</html>