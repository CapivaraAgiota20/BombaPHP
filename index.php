<?php
function validarCPF($cpf) {
    // Remove todos os caracter não numerico
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o CPF possui 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se há uma sequência de repetição de digitos
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Calcula os dígitos
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += intval($cpf[$i]) * (10 - $i);
    }
    $resto = ($soma % 11);
    $digito1 = ($resto < 2) ? 0 : (11 - $resto);

    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += intval($cpf[$i]) * (11 - $i);
    }
    $resto = ($soma % 11);
    $digito2 = ($resto < 2) ? 0 : (11 - $resto);

    // Verifica se os dígitos são iguais aos informados
    if ($cpf[9] != $digito1 || $cpf[10] != $digito2) {
        return false;
    }

    return true;
}

// Exemplo de uso:
$cpfTeste = "415.278.538-10";
if (validarCPF($cpfTeste)) {
    echo "CPF válido!";
} else {
    echo "CPF inválido!";
}
?>