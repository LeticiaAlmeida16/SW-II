<?php

// a) Leia o arquivo JSON usando file_get_contents().
$json_usuarios = file_get_contents("usuarios.json");

// b) Converta o JSON em um array PHP com json_decode().
$usuarios = json_decode($json_usuarios, true);

// c) Exiba os nomes e emails de todos os usuários.
foreach ($usuarios as $usuario) {
    echo "Nome: $usuario[nome] <br> Email: $usuario[email]\n <br><br>";
    }
?>