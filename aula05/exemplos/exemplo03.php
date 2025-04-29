<?php
    //string json
    //agora o primeiro empregado possui dependentes e os outros não.
    //também foi acrescentado um campo denominado "data", contendo a data do arquivo de empregados
    $json_str = '{"empregados": '. 
    '[{"nome":"Leticia Almeida", "idade":17, "sexo": "F", "dependentes": ["Janes Almeida", "Pedro Alemeida"]},'.
    '{"nome":"Luis", "idade":18, "sexo": "M"},'.
    '{"nome":"Luisa", "idade":26, "sexo": "F"}'.
    '],
    "data": "05/03/2008"}';

    //faz o parsing da string, criando o array "empregados"
    $jsonObj = json_decode($json_str);

    //cria o array de empregados
    $empregados = $jsonObj->empregados;

    //imprime a data do arquivo e navega pelos elementos do array, imprimindo cada empregado. 
    //caso o empregado possua dependentes, estes também são exibidos.
    echo "<b>data do arquivo</b>: $jsonObj->data<br/>";
    foreach ( $empregados as $e ){
        echo "nome: $e->nome - idade: $e->idade - sexo: $e->sexo<br/>";
        if (property_exists($e, "dependentes")) { 
            $deps = $e->dependentes;
            echo "dependentes: <br/>";
            foreach ( $deps as $d ) echo "- $d<br/>";
        }
    }
?>