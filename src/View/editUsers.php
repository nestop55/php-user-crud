<?php
require_once __DIR__ . '/../Database/Connector.php';
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Repository/UserRepository.php';
require_once __DIR__ . '/../Controller/UserController.php';

use App\Controller\UserController;
use App\Repository\UserRepository;

$controller = new UserController(new UserRepository());
$user = $controller->showUser((int) ($_GET['id'] ?? 0));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="View/css/style.css">
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
            <button type="submit">Guardar</button>
        </form>
    <?php endif; ?>
</body>
</html>