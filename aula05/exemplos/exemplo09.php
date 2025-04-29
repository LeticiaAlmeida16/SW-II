<?php
    $json = '{"nome": "Leticia", "idade": 17, "email": "leticiaalmeida@email.com"}';

    $dados = json_decode($json, true); // O segundo parâmetro "true" converte para array
    print_r($dados);
?>