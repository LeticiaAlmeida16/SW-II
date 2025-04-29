<?php
    //cria um array contendo 3 empregados
    $empregados = array('empregados' => array(
        array(
            'nome' => 'Leticia Almeida',
            'idade' => 17,
            'sexo' => 'F'
        ),
        array(
            'nome' => 'Luis',
            'idade' => 20,
            'sexo' => 'M'
        ),
        array(
            'nome' => 'Pedro',
            'idade' => 40,
            'sexo' => 'M'
        )));

    //converte o conteúdo do array para uma string JSON
    $json_str = json_encode($empregados);

    //imprime a string JSON
    echo "$json_str";
?>