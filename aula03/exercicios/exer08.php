<?php
    function NumAleatorios() {
        $array = [];

        for ($i = 0; $i < 10; $i++) {
            $array[] = rand(1, 100); 
        }

        return $array;
    }
    $nums = NumAleatorios();
    print_r($nums);
?>