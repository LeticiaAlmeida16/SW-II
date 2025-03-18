<?php
    //string json (array contendo 3 elementos)
    $json_str = '{"empregados": '. 
    '[{"nome":"Letícia Almeida", "idade":17, "sexo": "F"},'.
    '{"nome":"Luis", "idade":18, "sexo": "M"},'.
    '{"nome":"Luisa", "idade":20, "sexo": "F"}'.
    ']}';

    //faz o parsing da string, criando o array "empregados"
    $jsonObj = json_decode($json_str);
    $empregados = $jsonObj->empregados;

    //navega pelos elementos do array, imprimindo cada empregado
    foreach ( $empregados as $e )
    {
    echo "nome: $e->nome - idade: $e->idade - sexo: $e->sexo<br>"; 
    }
?>