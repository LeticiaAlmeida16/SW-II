<?php
    //string json contendo os dados de um funcionário
    $json_str = '{"nome": "Lele", "idade0": 17, "sexo":"F"}';
    
    //faz o parsing na string, gerando um objeto PHP
    $obj = json_decode($json_str);
   
    //imprime o conteúdo do objeto
    echo "nome: $obj->nome <br>";
    echo "idade: $obj->idade <br>";
    echo "sexo: $obj->sexo <br>";
?>