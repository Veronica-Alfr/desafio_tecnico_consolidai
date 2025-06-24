<?php
require_once __DIR__ . '/../controllers/ClientController.php';

header('Content-Type: application/json');

$clientController = new ClientController();
$clients = $clientController->list();

echo json_encode($clients);
