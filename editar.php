<?php
require_once 'Produto.php';

// Verificando se o id do produto foi passado via GET
if (isset($_GET['id'])) {
    // Instanciando o produto com o ID
    $produto = new Produto($_GET['id']);
    $produtoData = $produto->buscarPorId();
}

// Verificando se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Usando os setters para atualizar os valores
    $produto->setProduto($_POST['produto']);
    $produto->setValor($_POST['valor']);
    
    // Verificando se uma nova imagem foi enviada
    if ($_FILES['imagem']['name']) {
        // Se uma nova imagem foi enviada, alteramos a imagem
        $produto->setImagem($_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $_FILES['imagem']['name']);
    } else {
        // Se nenhuma imagem foi enviada, mantemos a imagem antiga
        $produto->setImagem($produtoData['imagem']);
    }

    // Atualizando o produto no banco de dados
    if ($produto->editar()) {
        header('Location: index.php');
    } else {
        echo "Erro ao editar produto!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Editar Produto</h1>
    <form action="editar.php?id=<?= $produtoData['id']; ?>" method="POST" enctype="multipart/form-data">
        <label for="produto">Nome do Produto</label>
        <!-- Usando o getter para obter o nome do produto -->
        <input type="text" name="produto" value="<?= $produtoData['produto']; ?>" required>

        <label for="valor">Valor</label>
        <!-- Usando o getter para obter o valor do produto -->
        <input type="number" name="valor" value="<?= $produtoData['valor']; ?>" step="0.01" required>

        <label for="imagem">Imagem</label>
        <input type="file" name="imagem" accept="image/*">

        <button type="submit">Salvar</button>
        <a href="index.php" class="btn">Cancelar</a>
    </form>
</body>
</html>
