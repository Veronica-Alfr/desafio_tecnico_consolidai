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
$status = trim($data['status'] ?? 'ativo');

$nome = trim($data['nome'] ?? '');
$cpf = trim($data['cpf'] ?? '');
$email = trim($data['email'] ?? '');
$id = isset($data['id']) && is_numeric($data['id']) ? (int)$data['id'] : null;

if ($nome === '' || $cpf === '' || $email === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Todos os campos são obrigatórios']);
    exit;
}

if (!preg_match('/^\d{3}\.?\d{3}\.?\d{3}\-?\d{2}$/', $cpf)) {
    http_response_code(400);
    echo json_encode(['error' => 'CPF inválido. Use o formato 000.000.000-00']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'E-mail inválido']);
    exit;
}

if (!in_array($status, ['ativo', 'inativo'], true)) {
    http_response_code(400);
    echo json_encode(['error' => 'Status inválido. Use "ativo" ou "inativo"']);
    exit;
}

try {
    $controller = new ClientController();

    if ($id) {
        $success = $controller->update($id, $nome, $cpf, $email, $status);
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