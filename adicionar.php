<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'Produto.php';

    $produto = new Produto(null, $_POST['produto'], $_POST['valor'], $_FILES['imagem']['name']);
    move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $_FILES['imagem']['name']);

    if ($produto->adicionar()) {
        header('Location: index.php');
    } else {
        echo "Erro ao adicionar produto!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Adicionar Produto</h1>
    <form action="adicionar.php" method="POST" enctype="multipart/form-data">
        <label for="produto">Nome do Produto</label>
        <input type="text" name="produto" required>

        <label for="valor">Valor</label>
        <input type="number" name="valor" step="0.01" required>

        <label for="imagem">Imagem</label>
        <input type="file" name="imagem" accept="image/*" required>

        <button type="submit">Adicionar</button>
        <a href="index.php" class="btn">Cancelar</a>
    </form>
</body>
</html>
