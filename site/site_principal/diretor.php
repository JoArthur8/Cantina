<?php include '../pedaco.php'; ?>

<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-danger fw-bold">Gerenciamento de Itens</h2>
        <a href="form_insere.php">
            <button class="btn btn-danger px-4 py-2 fw-semibold shadow-sm">+ Adicionar Item</button>
        </a>
    </div>

    <div class="table-responsive shadow-sm">
        <table class="table table-striped align-middle text-center">
            <thead class="table-danger text-white">
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Imagem</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require '../conexao.php';
                $sql = "SELECT * FROM Item";
                $stmt = $pdo->query($sql);
                while ($Item = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>{$Item['Cod_item']}</td>";
                    echo "<td class='fw-semibold'>{$Item['Nome']}</td>";
                    echo "<td>R$ " . number_format($Item['Preco'], 2, ',', '.') . "</td>";
                    echo "<td>{$Item['Quantidade_Estoque']}</td>";
                    echo "<td>{$Item['Tipo']}</td>";
                    echo "<td class='text-muted small'>{$Item['Descricao']}</td>";
                    echo "<td><img src='{$Item['Imagem']}' alt='{$Item['Nome']}' style='width: 80px; height: 80px; object-fit: cover; border-radius: 8px;'></td>";
                    echo "
                        <td>
                            <div class='btn-group' role='group'>
                                <a href='form_atualiza.php?Cod_item={$Item['Cod_item']}' class='btn btn-outline-danger btn-sm'>Atualizar</a>
                                <a href='deletar.php?Cod_item={$Item['Cod_item']}' class='btn btn-outline-warning btn-sm'>Apagar</a>
                            </div>
                        </td>
                    ";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
</body>
</html>
