<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'];

    // Remove caracteres não numéricos (caso venham por algum motivo)
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o CPF tem 11 dígitos
    if (strlen($cpf) !== 11) {
        die("O CPF deve conter exatamente 11 dígitos.");
    }

    // Função para validar o CPF
    function validarCPF($cpf) {
        // Elimina CPFs inválidos conhecidos
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Calcula os dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    // Valida o CPF
    if (!validarCPF($cpf)) {
        die("O CPF informado é inválido.");
    }

    // Continue com o processamento...
    echo "CPF válido! Continuando o cadastro...";
}
?>