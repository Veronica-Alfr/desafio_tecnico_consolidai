<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;
    
    public function __construct() {
        $this->host = $_ENV['DB_HOST'] ?? 'localhost';
        $this->db_name = $_ENV['DB_NAME'] ?? 'clientes_db2';
        $this->username = $_ENV['DB_USER'] ?? 'root';
        $this->password = $_ENV['DB_PASS'] ?? '';
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Garante que a tabela exista
            $this->ensureTableExists();

        } catch (PDOException $e) {
            if ($e->getCode() === 1049) {
                // Cria o banco e as tabelas se o banco não existir
                $this->createDatabaseAndTables();
            } else {
                die("Erro de conexão: " . $e->getMessage());
            }
        }

        return $this->conn;
    }

    private function ensureTableExists() {
        try {
            $sql = "
                CREATE TABLE IF NOT EXISTS clientes (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nome VARCHAR(255) NOT NULL,
                    cpf VARCHAR(20) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    status ENUM('ativo', 'inativo', 'excluido') NOT NULL DEFAULT 'ativo',
                    data_alteracao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
            $this->conn->exec($sql);
        } catch (PDOException $e) {
            die("Erro ao verificar/criar tabela: " . $e->getMessage());
        }
    }

    private function createDatabaseAndTables() {
        try {
            // Conecta sem banco apenas para criar o banco
            $tempConn = new PDO(
                "mysql:host={$this->host};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $tempConn->exec("CREATE DATABASE IF NOT EXISTS {$this->db_name} 
                CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

            // Reconecta usando o banco criado
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Cria a tabela após criar o banco
            $this->ensureTableExists();

        } catch (PDOException $e) {
            die("Erro ao criar banco/tabela: " . $e->getMessage());
        }
    }
}