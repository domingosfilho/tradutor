<?php

if (!isset($_POST['mensagem'])) {
    echo "Erro";
    exit;
}

$entrada = strtolower(trim($_POST['mensagem']));

$arquivo = fopen("corrigido.csv", "r");

if (!$arquivo) {
    echo "Agente Em Treinamento - Ainda Não Consigo Traduzir";
    exit;
}

$encontrado = false;

while (($linha = fgetcsv($arquivo, 1000, ",")) !== FALSE) {

    // coluna 0 = inglês
    // coluna 1 = português (ajuste se necessário)
    $ingles = strtolower(trim($linha[0]));
    $portugues = $linha[1] ?? "";

    if ($ingles == $entrada) {
        echo $portugues;
        $encontrado = true;
        break;
    }
}

fclose($arquivo);

if (!$encontrado) {
    echo "Agente Em Treinamento - Ainda Não Consigo Traduzir";
}