<?php
// a) Leia o JSON do arquivo e o converta para um array
$json_produtos = file_get_contents("produtos.json");
$produtos = json_decode($json_produtos, true);

// b) Adicione um novo produto ao array
$novo_produto = array("nome" => "Meias", "preco" => 9.90, "quantidade" => 20);
$produtos[] = $novo_produto;

// c) Converter o array atualizado para JSON e salvar de volta no arquivo
$json_atualizado = json_encode($produtos, JSON_PRETTY_PRINT);
file_put_contents("produtos.json", $json_atualizado);

// echo "$json_atualizado <br>";
// mensagem
echo "Produto adicionado com sucesso!";

?>
