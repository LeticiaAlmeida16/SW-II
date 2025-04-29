<?php
    $dados = [
        "nome" => "Leticia Almeida",
        "idade" => 17,
        "email" => "leticiaalmeida@email.com"
    ];
    
    $json = json_encode($dados, JSON_PRETTY_PRINT);
    echo $json;
?>