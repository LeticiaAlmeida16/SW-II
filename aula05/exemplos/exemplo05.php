<?php
    //cria o array associativo
    $idades = array("Leticia"=>17, "Luis"=>15, "Pedro"=>17);

    //converte o conteúdo do array associativo para uma string JSON
    $json_str = json_encode($idades);

    //imprime a string JSON
    echo "$json_str";
?>