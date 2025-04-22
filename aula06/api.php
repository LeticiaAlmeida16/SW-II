<?php
//CABEÇALHO
header("Content-Type: application/json; charset=UTF-8");  // <- DEFINE O TIPO DE RESPOSTA

$metodo = $_SERVER['REQUEST_METHOD'];

// RECUPERA O ARQUIVO JSON NA MESMA PASTA DO PROJETO
$arquivo = 'usuarios.json';

// VERIFICA SE O ARQUIVO EXISTE, CASO CONTRARIO CRIA UM ARRAY VAZIO
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// LE O CONTEUDO DO ARQUIVO JSON
$usuarios = json_decode(file_get_contents($arquivo), true);

switch ($metodo) {
    case 'GET':
        //verifica se há um parametro 'id' na URL
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $usuario_encontrado = null;

            // procura o usuario pelo id
            foreach ($usuarios as $usuario) {
                if ($usuario['id'] === $id) {
                    $usuario_encontrado = $usuario;
                    break;
                }
            }

            if ($usuario_encontrado) {
                echo json_encode($usuario_encontrado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(["erro" => "Usuário não encontrado."], JSON_UNESCAPED_UNICODE);
            }
        } else {
            //retorna todos os usuarios
            echo json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        break;

    case 'POST':
        // LE OS DADOS NO CORPO DA REQUISIÇÃO
        $dados = json_decode(file_get_contents('php://input'), true);

        // VERIFICA SE OS CAMPOS OBRIGATÓRIOS ESTÃO PREENCHIDOS (sem exigir id)
        if (!isset($dados["nome"]) || !isset($dados["email"])) {
            http_response_code(400);
            echo json_encode(["erro" => "NOME E EMAIL SÃO OBRIGATÓRIOS."], JSON_UNESCAPED_UNICODE);
            exit;
        }

        //GERA UM NOVO ID UNICO
        $novo_id = 1;
        if (!empty($usuarios)) {
            $ids = array_column($usuarios, 'id');
            $novo_id = max($ids) + 1;
        }

        // CRIA NOVO USUÁRIO
        $novoUsuario = [
            "id" => $novo_id,
            "nome" => $dados["nome"],
            "email" => $dados["email"]
        ];

        // ADICIONA AO ARRAY DE USUÁRIOS
        $usuarios[] = $novoUsuario;

        //SALVA O ARRAY ATUALIZADO NO ARQ. JSON
        file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // RETORNA MENSAGEM DE SUCESSO
        echo json_encode([
            'mensagem' => 'Usuário inserido com sucesso',
            'usuarios' => $novoUsuario
        ], JSON_UNESCAPED_UNICODE);
        break;

    default:
        http_response_code(405); //Método não permitido
        echo json_encode(['erro' => 'Método não permitido'], JSON_UNESCAPED_UNICODE);
        break;
}
