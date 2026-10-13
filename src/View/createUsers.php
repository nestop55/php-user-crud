<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="View/css/style.css?v=<?= filemtime(__DIR__ . '/css/style.css'); ?>">
</head>
<body>
    <h1>Nuevo Usuario</h1>

    <form method="post" action="index.php?action=create">
        <input type="text" name="name" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <button class="createButton" type="submit">Guardar</button>
        <a class="cancelAnchor" href="index.php">Cancelar</a>
    </form>

</body>
</html>