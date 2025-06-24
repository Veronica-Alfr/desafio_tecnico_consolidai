<?php
require_once __DIR__ . '/../controllers/ClientController.php';

$controller = new ClientController();
$id = $_GET['id'] ?? null;
$cliente = $id ? $controller->get($id) : ['nome' => '', 'cpf' => '', 'email' => ''];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? 'Editar Cliente' : 'Novo Cliente' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4"><?= $id ? 'Editar Cliente' : 'Novo Cliente' ?></h1>

    <div class="card">
        <div class="card-body">
            <form id="client-form">
                <input type="hidden" id="id" value="<?= htmlspecialchars($id) ?>">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" id="nome" class="form-control" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" id="cpf" class="form-control" value="<?= htmlspecialchars($cliente['cpf']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" id="email" class="form-control" value="<?= htmlspecialchars($cliente['email']) ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"><?= $id ? 'Atualizar' : 'Salvar' ?></button>
                <a href="index.php?page=list" class="btn btn-secondary">Voltar</a>
            </form>
            <div id="form-message" class="mt-3"></div>
        </div>
    </div>
</div>

<script>
$('#client-form').on('submit', function (e) {
    e.preventDefault();

    const payload = {
        id: $('#id').val() || null,
        nome: $('#nome').val(),
        cpf: $('#cpf').val(),
        email: $('#email').val()
    };

    $.ajax({
        url: 'api/create_or_update_ajax.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(payload),
        success: function () {
            const msg = payload.id ? 'Cliente atualizado com sucesso!' : 'Cliente salvo com sucesso!';
            $('#form-message').html('<div class="alert alert-success">' + msg + '</div>');
            setTimeout(() => window.location.href = 'index.php?page=list', 1500);
        },
        error: function (xhr) {
            const msg = xhr.responseJSON?.error ?? 'Erro ao salvar';
            $('#form-message').html('<div class="alert alert-danger">' + msg + '</div>');
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>