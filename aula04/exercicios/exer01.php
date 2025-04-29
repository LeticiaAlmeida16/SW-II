<?php

// Crie um array associativo chamado $pessoa com as seguintes chaves: 
// nome, idade, cidade.
// Adicione uma nova chave chamada profissao ao array.
// Crie um array indexado chamado $amigos com os nomes de três amigos.
// Combine os arrays $pessoa e $amigos em um novo array chamado $dados.
// Exiba o conteúdo do array $dados usando print_r.

$pessoa = array("nome" => "Lelê", "idade" => 17, "cidade" => "Rib Pires");

$pessoa["profissao"] = "Estudante";

$amigos = array("Janes", "Pedro", "Ric");

$dados = array_merge($pessoa, $amigos);

print_r($dados);

?>