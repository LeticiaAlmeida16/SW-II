<?php
// duvida
// a) Perguntar ao usuário um email (via $_GET)
// http://localhost/SW-II/aula05/exercicios/exer04.php?email=leticia@gmail.com
$email_busca = $_GET["email"];

// Ler o JSON do arquivo e converter para um array
$json_usuarios = file_get_contents("usuarios.json");
$usuarios = json_decode($json_usuarios, true);

// b) Buscar no array de usuários um que tenha esse email
$usuario_encontrado = null;
foreach ($usuarios as $usuario) {
  if ($usuario["email"] == $email_busca) {
    $usuario_encontrado = $usuario;
    break;
  }
}

// c) Exibir os dados do usuário encontrado ou uma mensagem de erro
if ($usuario_encontrado) {
  echo "Usuário encontrado:<br>";
  echo "Nome: " . $usuario_encontrado["nome"] . "<br>";
  echo "Email: " . $usuario_encontrado["email"] . "<br>";
} else {
  echo "Usuário não encontrado.";
}

?>