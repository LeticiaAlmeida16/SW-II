<?php
// Criar um array associativo com os produtos.
 $produtos = array(
    array('nome' => 'Camisa', 'preco' => 50.90, 'quantidade' => 100),
    array('nome' => 'Blusa', 'preco' => 98.99, 'quantidade' => 50),
    array('nome' => 'Calca', 'preco' => 119.20, 'quantidade' => 150)
    );
// Converter para JSON com json_encode().
    $json = json_encode($produtos);
// Salvar o JSON em um arquivo com file_put_contents().
    file_put_contents('produtos.json', $json);

// echo $json;
// mostra que foi salvo 
    echo "Arquivo produtos.json criado com sucesso!";
?>