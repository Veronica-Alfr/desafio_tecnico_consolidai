<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require_once __DIR__ . '/../controllers/ClientController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$nome = trim($data['nome'] ?? '');
$cpf = trim($data['cpf'] ?? '');
$email = trim($data['email'] ?? '');
$id = isset($data['id']) && is_numeric($data['id']) ? (int)$data['id'] : null;

if ($nome === '' || $cpf === '' || $email === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Todos os campos são obrigatórios']);
    exit;
}

try {
    $controller = new ClientController();

    if ($id) {
        $success = $controller->update($id, $nome, $cpf, $email);
    } else {
        $success = $controller->create($nome, $cpf, $email);
    }

    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao salvar no banco']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao salvar cliente: ' . $e->getMessage()]);
}