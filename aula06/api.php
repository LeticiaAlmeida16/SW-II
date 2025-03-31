<?php
    //cabeçalho
    header("Content-Type: application/json");  // <- define o tipo de resposta

    $metodo = $_SERVER['REQUEST_METHOD'];

    // echo "Método da requisição: " . $metodo;

    //conteúdo
    $usuarios = [
        ["id" => 1, "nome" => "Letícia Almeida", "email" => "lealmeidan@email.com"],
        ["id" => 2, "nome" => "Maria Eduarda", "email" => "duda@email.com"]
    ];

    switch ($metodo) {
        case 'GET':
            //echo "Método GET";
            //Converte para JSON e retorna
            echo json_encode($usuarios);
            break;
        case 'POST':
            // echo "Método POST";
            $dados = json_decode(file_get_contents('php://input'), true);
            // print_r($dados);
            
            $novoUsuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];

            //adiciona o novo usuario ao array existente
            array_push($usuarios, $novoUsuario);
            echo json_encode('Usuário inserido com sucesso!');
            print_r($usuarios);

            break;

        default:
            echo "Método não encontrado";
            break;
    }

    // // converte para JSON e retorna
    // echo json_encode($usuarios);  
?>
