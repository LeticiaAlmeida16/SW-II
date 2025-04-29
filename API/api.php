<?php
// CABEÇALHO
header("Content-Type: application/json; charset=UTF-8");

$metodo = $_SERVER['REQUEST_METHOD'];
$arquivo = 'usuarios.json';

// GARANTE QUE O ARQUIVO EXISTA
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// LÊ OS DADOS EXISTENTES
$usuarios = json_decode(file_get_contents($arquivo), true);

switch ($metodo) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $usuario_encontrado = null;

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
            echo json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        break;

    case 'POST':
        $dados = json_decode(file_get_contents('php://input'), true);

        if (!isset($dados["nome"]) || !isset($dados["email"])) {
            http_response_code(400);
            echo json_encode(["erro" => "NOME E EMAIL SÃO OBRIGATÓRIOS."], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $novo_id = 1;
        if (!empty($usuarios)) {
            $ids = array_column($usuarios, 'id');
            $novo_id = max($ids) + 1;
        }

        $novoUsuario = [
            "id" => $novo_id,
            "nome" => $dados["nome"],
            "email" => $dados["email"]
        ];

        $usuarios[] = $novoUsuario;
        file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        echo json_encode([
            'mensagem' => 'Usuário inserido com sucesso',
            'usuarios' => $novoUsuario
        ], JSON_UNESCAPED_UNICODE);
        break;

    case 'PUT':
        $dados = json_decode(file_get_contents('php://input'), true);

        if (!isset($dados["id"])) {
            http_response_code(400);
            echo json_encode(["erro" => "ID é obrigatório para atualizar um usuário."], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $id = intval($dados["id"]);
        $usuarioAtualizado = null;

        foreach ($usuarios as &$usuario) {
            if ($usuario['id'] === $id) {
                if (isset($dados["nome"])) {
                    $usuario["nome"] = $dados["nome"];
                }
                if (isset($dados["email"])) {
                    $usuario["email"] = $dados["email"];
                }
                $usuarioAtualizado = $usuario;
                break;
            }
        }

        if ($usuarioAtualizado) {
            file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            echo json_encode([
                "mensagem" => "Usuário atualizado com sucesso.",
                "usuario" => $usuarioAtualizado
            ], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(404);
            echo json_encode(["erro" => "Usuário não encontrado."], JSON_UNESCAPED_UNICODE);
        }
        break;

    case 'DELETE':
        $dados = json_decode(file_get_contents('php://input'), true);

        if (!isset($dados["id"])) {
            http_response_code(400);
            echo json_encode(["erro" => "ID é obrigatório para excluir um usuário."], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $id = intval($dados["id"]);
        $usuarioEncontrado = false;

        foreach ($usuarios as $index => $usuario) {
            if ($usuario['id'] === $id) {
                $usuarioEncontrado = true;
                unset($usuarios[$index]);
                $usuarios = array_values($usuarios); // reorganiza os índices
                break;
            }
        }

        if ($usuarioEncontrado) {
            file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            echo json_encode(["mensagem" => "Usuário excluído com sucesso."], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(404);
            echo json_encode(["erro" => "Usuário não encontrado."], JSON_UNESCAPED_UNICODE);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['erro' => 'Método não permitido'], JSON_UNESCAPED_UNICODE);
        break;
}
