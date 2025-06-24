<?php
require_once __DIR__ . '/../config/database.php';

class ClientModel {
    public $conn;
    private $table = 'clientes';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table} WHERE status != 'excluido' ORDER BY id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nome, $cpf, $email) {
        $query = "INSERT INTO {$this->table} (nome, cpf, email) VALUES (:nome, :cpf, :email)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':nome' => $nome,
            ':cpf' => $cpf,
            ':email' => $email
        ]);
    }

    public function getById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id AND status != 'excluido' ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $cpf, $email) {
        $stmt = $this->conn->prepare("
            UPDATE {$this->table}
            SET nome = :nome, cpf = :cpf, email = :email
            WHERE id = :id
        ");
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':cpf' => $cpf,
            ':email' => $email
        ]);
    }

    public function delete($id) {
        $query = "UPDATE {$this->table} SET status = 'excluido' WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}