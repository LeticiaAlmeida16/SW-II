<?php
$dados = null;
$erro = null;


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $cep = preg_replace('/[^0-9]/', '', $_POST["cep"]);
    
            $url = "https://viacep.com.br/ws/{$cep}/json/";
            $resposta = file_get_contents($url);
    
            if ($resposta !== false) {
                $dados = json_decode($resposta, true);
    
                if (isset($dados['erro']) && $dados['erro'] === true) {
                    $erro = "CEP não encontrado.";
                    $dados = null;
                    echo $erro;
                }
                if($dados["erro"] == "true") {
                    $erro = "CEP não encontrado.";
                }
        } else {
            $erro = "CEP inválido. Digite exatamente 8 números.";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta de CEP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Consulta de Endereço (ViaCEP)</h1>

    <form method="POST" onsubmit="return validarCEP();">
    <input type="text" name="cep" id="cep" placeholder="Digite o CEP (Ex: 01001000)" 
           maxlength="8" pattern="\d{8}" required>
    <button type="submit">Buscar</button>
</form>

    <div>
        <?php if ($erro): ?>
            <p><?php echo $erro; ?></p>
        <?php elseif ($dados): ?>
            <h3>Resultado:</h3>
            <ul>
                <li><strong>Logradouro:</strong> <?php echo htmlspecialchars($dados['logradouro']); ?></li>
                <li><strong>Bairro:</strong> <?php echo htmlspecialchars($dados['bairro']); ?></li>
                <li><strong>Localidade:</strong> <?php echo htmlspecialchars($dados['localidade']); ?></li>
                <li><strong>UF:</strong> <?php echo htmlspecialchars($dados['uf']); ?></li>
                <li><strong>UF:</strong> <?php echo htmlspecialchars($dados['estado']); ?></li>
                <li><strong>Região:</strong> <?php echo htmlspecialchars($dados['regiao']); ?></li>
            </ul>
        <?php endif; ?>
    </div>

    <script>
function validarCEP() {
    const cep = document.getElementById("cep").value;
    const regex = /^\d{8}$/;

    if (!regex.test(cep)) {
        alert("Por favor, digite exatamente 8 números.");
        return false;
    }

    return true;
}
</script>
</body>
</html>
