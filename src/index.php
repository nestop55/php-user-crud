<?php

require_once __DIR__ . '/Database/Connector.php';
require_once __DIR__ . '/Model/User.php';
require_once __DIR__ . '/Repository/UserRepository.php';
require_once __DIR__ . '/Controller/UserController.php';

use App\Controller\UserController;
use App\Repository\UserRepository;

$controller = new UserController(new UserRepository());
$action = $_GET['action'] ?? 'list';

if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->createUser([
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
    ]);
    $action = 'list';
}

if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->updateUser(
        (int) ($_POST['id'] ?? 0),
        [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
        ]
    );
    $action = 'list';
}

if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller->deleteUser((int) ($_GET['id'] ?? 0));
    $action = 'list';
}

if ($action === 'edit' && isset($_GET['id'])) {
    $user = $controller->showUser((int) $_GET['id']);
    require __DIR__ . '/View/editUsers.php';
    exit;
}

$users = $controller->listUsers();
require __DIR__ . '/View/users.php';

