<?php
class Database {
    private $host = "db";
    private $db_name = "clientes_db";
    private $username = "root";
    private $password = "password";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "
                CREATE TABLE IF NOT EXISTS clientes (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nome VARCHAR(255) NOT NULL,
                    cpf VARCHAR(20) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    status ENUM('ativo', 'inativo', 'excluido') NOT NULL DEFAULT 'ativo',
                    data_alteracao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                );
            ";

            $this->conn->exec($sql);
        } catch (PDOException $exception) {
            echo "Erro ao criar/verificar tabela: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>