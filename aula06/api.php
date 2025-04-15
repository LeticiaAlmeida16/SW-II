<?php
    //CABEÇALHO
    header("Content-Type: application/json; charset=UTF-8");  // <- DEFINE O TIPO DE RESPOSTA


    $metodo = $_SERVER['REQUEST_METHOD'];
    // echo "Método da requisição: " . $metodo;

    // RECUPERA O ARQUIVO JSON NA MESMA PASTA DO PROJETO
    $arquivo = 'usuarios.json';

    // VERIFICA SE O ARQUIVO EXISTE, CASO CONTRARIO CRIA UM ARRAY VAZIO
    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    // LE O CONTEUDO DO ARQUIVO JSON
    $usuarios = json_decode(file_get_contents($arquivo), true);

    //CONTEÚDO
    // $usuarios = [
    //    ["id" => 1, "nome" => "Letícia Almeida", "email" => "lealmeidan@email.com"],
    //    ["id" => 2, "nome" => "Maria Eduarda", "email" => "duda@email.com"]
    // ];

    switch ($metodo) {
        case 'GET':
            //echo "Método GET";
            //CONVERTE PARA JSON E RETORNA
            echo json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            break;
        case 'POST':
            // echo "Método POST";
            // LE OS DADOS NO CORPO DA REQUISIÇÃO
            $dados = json_decode(file_get_contents('php://input'), true);
            // print_r($dados);

            // VERIFICA SE OS CAMPOS OBRIGATÓRIOS ESTÃO PREENCHIDOS
            if (!isset($dados["id"]) || !isset($dados["nome"]) || !isset($dados["email"])) {
                http_response_code(400);
                echo json_encode(["erro" => "Dados incompletos."], JSON_UNESCAPED_UNICODE);
                exit;
            }

            // CRIA NOVO USUÁRIO
            $novoUsuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];

            // ADICIONA AO ARRAY DE USUÁRIOS
            $usuarios[] = $novoUsuario;

            //SALVA O ARRAY ATUALIZADO NO ARQ. JSON
            file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            // RETORNA MENSAGEM DE SUCESSO
            echo json_encode(['mensagem' => 'Usuário inserido com sucesso', 'usuarios' => $usuarios], JSON_UNESCAPED_UNICODE);
            break;

            //ADICIONA O NOVO USUARIO AO ARRAY EXISTENTE
            //array_push($usuarios, $novoUsuario);
            //echo json_encode('Usuário inserido com sucesso!');
            //print_r($usuarios);
            //break;

        default:
            //echo "Método não encontrado";
            //break;
            http_response_code(405); //Método não permitido
            echo json_encode(['erro' => 'Método não permitido'], JSON_UNESCAPED_UNICODE);
            break;
    }

    // // CONVERTE PARA JSON E RETORNA
    // echo json_encode($usuarios);  
?>