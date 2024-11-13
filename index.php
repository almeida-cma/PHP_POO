<?php
require_once 'Produto.php';

$produto = new Produto();
$produtos = $produto->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Produtos</h1>
    <a href="adicionar.php" class="btn">Adicionar Produto</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Valor</th>
            <th>Imagem</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($produtos as $produto) : ?>
        <tr>
            <td><?= $produto['id']; ?></td>
            <td><?= $produto['produto']; ?></td>
            <td>R$ <?= number_format($produto['valor'], 2, ',', '.'); ?></td>
            <td><img src="uploads/<?= $produto['imagem']; ?>" width="100"></td>
            <td>
                <a href="editar.php?id=<?= $produto['id']; ?>">Editar</a> |
                <a href="excluir.php?id=<?= $produto['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
