<?php

require_once __DIR__ . "/../config/Database.php";

class UsuarioModel {

    private $tabela = "usuario";
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function listar() {
        $query = "SELECT * FROM $this->tabela;";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarPorId($id) {
        $query = "SELECT * FROM $this->tabela WHERE id = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function criar($nome, $email, $dataNascimento, $cpf) {
        $query = "INSERT INTO $this->tabela (nome, email, data_nascimento, cpf) VALUES (:nome, :email, :data_nascimento, :cpf);";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':data_nascimento', $dataNascimento);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
    
        return $stmt->rowCount() > 0;
    }

    public function editar($usuario) {
        $query = "UPDATE $this->tabela SET nome = :nome, email = :email, dataNascimento = :data_nascimento, cpf = :cpf WHERE id = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $usuario["id"]);
        $stmt->bindParam(":nome", $usuario["nome"]);
        $stmt->bindParam(":email", $usuario["email"]);
        $stmt->bindParam(":data_nascimento", $usuario["data_nascimento"]);
        $stmt->bindParam(":cpf", $usuario["cpf"]);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function excluir($id) {
        $query = "DELETE FROM $this->tabela WHERE id = :id;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}

