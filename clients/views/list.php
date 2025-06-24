<?php
require_once __DIR__ . '/../controllers/ClientController.php';

$controller = new ClientController();
$clients = $controller->list();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Lista de Clientes</h1>
        <a href="index.php?page=edit" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Novo Cliente
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle" id="clients-table">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Data Alteração</th>
                    <th class="text-center">Ações</th> <!-- Coluna para botões -->
                </tr>
            </thead>
            <tbody>
                <?php if (empty($clients)): ?>
                    <tr>
                        <td colspan="7" class="text-center">Nenhum cliente encontrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($clients as $client): ?>
                        <tr data-id="<?= htmlspecialchars($client['id']) ?>">
                            <td><?= htmlspecialchars($client['id']) ?></td>
                            <td><?= htmlspecialchars($client['nome']) ?></td>
                            <td><?= htmlspecialchars($client['cpf']) ?></td>
                            <td><?= htmlspecialchars($client['email']) ?></td>
                            <td><?= htmlspecialchars($client['status']) ?></td>
                            <td><?= htmlspecialchars($client['data_alteracao']) ?></td>
                            <td class="text-center">
                                <a href="index.php?page=edit&id=<?= htmlspecialchars($client['id']) ?>" class="btn btn-sm btn-primary me-1" title="Editar">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger btn-delete" title="Excluir">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#clients-table').on('click', '.btn-delete', function() {
        if (!confirm('Tem certeza que deseja excluir este cliente?')) {
            return;
        }

        const row = $(this).closest('tr');
        const clientId = row.data('id');

        $.ajax({
            url: 'api/delete_ajax.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id: clientId }),
            success: function(response) {
                if (response.success) {
                    row.fadeOut(400, function() {
                        $(this).remove();
                        if ($('#clients-table tbody tr').length === 0) {
                            $('#clients-table tbody').append('<tr><td colspan="7" class="text-center">Nenhum cliente encontrado.</td></tr>');
                        }
                    });
                } else {
                    alert(response.error || 'Erro ao excluir cliente.');
                }
            },
            error: function() {
                alert('Erro ao excluir cliente.');
            }
        });
    });
});
</script>

</body>
</html>