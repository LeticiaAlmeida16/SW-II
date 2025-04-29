<?php
//duvida
// a) Le os produtos do JSON
$produtos = json_decode(file_get_contents('produtos.json'), true);

// b) Remove um produto específico
$nomeProduto = 'Camisa'; // exemplo
$produtosAntes = $produtos; // Salva o array original para comparação

$produtos = array_filter($produtos, function($produto) use ($nomeProduto) {
    return $produto['nome'] != $nomeProduto;
});

// c) Salve o novo JSON atualizado no arquivo 
file_put_contents('produtos.json', json_encode(array_values($produtos), JSON_PRETTY_PRINT));

// Verifica se o produto foi removido
if (count($produtos) < count($produtosAntes)) {
    echo "Produto removido com sucesso!";
} else {
    echo "Produto não encontrado ou não removido.";
}

?>