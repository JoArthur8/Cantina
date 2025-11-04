<?php
include '../pedaco.php'
    ?>

    <div class="container">
            <div class="col-md-6 text-end">
                <a href="form_insere.php" ><button class="btn btn-danger">ADICIONAR ITEM</button></a>
            </div>
        </div>
    </div>   

<div class="container">

    <table class="table  table-striped">
        <thead>
            <tr>
                <th scope="col">CÓDIGO</th>
                <th scope="col">NOME</th>
                <th scope="col">PREÇO</th>
                <th scope="col">QUANTIDADE</th>
                <th scope="col">TIPO</th>
                <th scope="col">DESCRIÇÃO</th>
                <th scope="col">OPÇÕES</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require '../conexao.php';
            $sql = "SELECT * FROM Item";
            $stmt = $pdo->query($sql);
            while ($Item = $stmt->fetch(PDO::FETCH_ASSOC)) {

                echo "<tr>";

                echo "<td>" . $Item['Cod_item'] . "</td>";
                echo "<td>" . $Item['Nome'] . "</td>";
                echo "<td>" . $Item['Preco'] . "</td>";
                echo "<td>" . $Item['Quantidade_Estoque'] . "</td>";
                echo "<td>" . $Item['Tipo'] . "</td>";
                echo "<td>" . $Item['Descricao'] . "</td>";
                echo "
                        <td>
                            <div class='btn-group' role='group'>
                                <a href='form_atualiza.php?Cod_item=" . $Item['Cod_item'] . "' type='button' class='btn btn-danger'>ATUALIZAR</a>
                                <a href='deletar.php?Cod_item=" . $Item['Cod_item'] . "' type='button' class='btn btn-warning'>APAGAR</a>
                            </div>
                        </td>
                        ";

                echo "</tr>";

            }
            ?>

        </tbody>
    </table>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>

</body>

</html>