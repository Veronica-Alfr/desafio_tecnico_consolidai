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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            <td>
                                <a href="index.php?page=edit&id=<?= htmlspecialchars($client['id']) ?>" class="btn btn-sm btn-primary me-1" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="<?= htmlspecialchars($client['id']) ?>" title="Excluir">
                                    <i class="bi bi-trash"></i>
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
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();

        const clientId = $(this).data('id');

        Swal.fire({
            title: 'Tem certeza?',
            text: "Você não poderá reverter essa ação!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'api/delete_ajax.php',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ id: clientId }),
                    success: function () {
                        Swal.fire(
                            'Excluído!',
                            'Cliente excluído com sucesso.',
                            'success'
                        );

                        $('button.btn-delete[data-id="' + clientId + '"]').closest('tr').fadeOut(400, function() {
                            $(this).remove();
                            if ($('#clients-table tbody tr').length === 0) {
                                $('#clients-table tbody').append('<tr><td colspan="7" class="text-center">Nenhum cliente encontrado.</td></tr>');
                            }
                        });
                    },
                    error: function () {
                        Swal.fire(
                            'Erro',
                            'Falha ao excluir o cliente.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>
</body>
</html>