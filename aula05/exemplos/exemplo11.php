<?php
    $dados = [
        "produto" => "Celular",
        "preco" => 2230,
        "estoque" => 13
    ];
    
    $json = json_encode($dados, JSON_PRETTY_PRINT);
    file_put_contents("dados2.json", $json);
?>