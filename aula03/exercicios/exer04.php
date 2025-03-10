<?php
    function tabuada($num){
        for ($i=1; $i <= 10 ; $i++) { 
            $mult = $i * $num;
            echo "O resultado de $num x $i é: $mult <br>" ;
        }
    }

    tabuada(16);
?>
