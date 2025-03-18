<?php
    //cria uma string no formato JSON
    $json_str = '{"Leticia":17,"Luis":28,"Pedro":32}';

    //transforma a string em um array associativo
    $json_arr = json_decode($json_str, true);

    //exibe o array associativo
    var_dump($json_arr);
?>