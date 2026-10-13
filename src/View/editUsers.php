<?php
/** @var array|null $user */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="View/css/style.css?v=<?= filemtime(__DIR__ . '/css/style.css'); ?>">
</head>

</head>
<body>
    <h1>Editar usuario</h1>

    <?php if ($user === null): ?>
        <p>Usuario no encontrado.</p>
    <?php else: ?>
        <form method="post" action="index.php?action=update">
            <input type="hidden" name="id" value="<?= htmlspecialchars((string) $user['id']); ?>">
            <input type="text" name="name" placeholder="Nombre" value="<?= htmlspecialchars($user['name']); ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($user['email']); ?>" required>
            <button class="createButton" type="submit">Guardar</button>
            <a class="cancelAnchor" href="index.php">Cancelar</a>
        </form>
    <?php endif; ?>
</body>
</html>