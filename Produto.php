<?php
require_once 'conexao.php';

class Produto {
    private $id;
    private $produto;
    private $valor;
    private $imagem;
    private $conn;

    public function __construct($id = null, $produto = null, $valor = null, $imagem = null) {
        $this->conn = (new Conexao())->conectar();
        $this->id = $id;
        $this->produto = $produto;
        $this->valor = $valor;
        $this->imagem = $imagem;
    }
	
	    // Construtor e outros métodos

    public function getProduto() {
        return $this->produto;
    }

    public function setProduto($produto) {
        $this->produto = $produto;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function adicionar() {
        $sql = "INSERT INTO produtos (produto, valor, imagem) VALUES (:produto, :valor, :imagem)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':produto', $this->produto);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':imagem', $this->imagem);
        return $stmt->execute();
    }

    public function editar() {
        $sql = "UPDATE produtos SET produto = :produto, valor = :valor, imagem = :imagem WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':produto', $this->produto);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':imagem', $this->imagem);
        return $stmt->execute();
    }

    public function excluir() {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function listar() {
        $sql = "SELECT * FROM produtos";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId() {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
