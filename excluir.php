<?php
require_once 'Produto.php';

if (isset($_GET['id'])) {
    $produto = new Produto($_GET['id']);
    if ($produto->excluir()) {
        header('Location: index.php');
    } else {
        echo "Erro ao excluir produto!";
    }
}
?>
