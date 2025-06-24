<?php
require_once __DIR__ . '/../models/ClientModel.php';

class ClientController {
    private $model;

    public function __construct() {
        $this->model = new ClientModel();
    }

    public function list() {
        return $this->model->getAll();
    }

    public function create($nome, $cpf, $email) {
        return $this->model->create($nome, $cpf, $email);
    }

    public function get($id) {
        return $this->model->getById($id);
    }

    public function update($id, $nome, $cpf, $email) {
        return $this->model->update($id, $nome, $cpf, $email);
    }

    public function delete($id) {
        return $this->model->delete($id);
    }
}