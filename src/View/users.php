<?php
/** @var array $users */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
    <link rel="stylesheet" href="View/css/style.css?v=<?= filemtime(__DIR__ . '/css/style.css'); ?>">
</head>
<body>
    <h1>Usuarios</h1>

    <form method="post" action="index.php?action=search">
        <input type="text" name="search" placeholder="Buscar">
        <button type="submit">Buscar</button>
        <a class="createAnchor" href="index.php?action=create">Nuevo Usuario</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($users)): ?>
                <tr>
                    <td colspan="3">No hay usuarios registrados.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars((string) $user['id']); ?></td>
                        <td><?= htmlspecialchars($user['name']); ?></td>
                        <td><?= htmlspecialchars($user['email']); ?></td>
                        <td>
                            <form method="post" action="index.php?action=edit">
                                <input type="hidden" name="id" value="<?= (int) $user['id']; ?>">
                                <button class="editButton" type="submit">EDIT</button>
                            </form>
                                                                                   <form method="post" action="index.php?action=delete">
                                <input type="hidden" name="id" value="<?= (int) $user['id']; ?>">
                                <button class="deleteButton" type="submit">DELETE</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>