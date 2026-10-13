<?php

require_once __DIR__ . '/Database/Connector.php';
require_once __DIR__ . '/Model/User.php';
require_once __DIR__ . '/Repository/UserRepository.php';
require_once __DIR__ . '/Controller/UserController.php';

use App\Controller\UserController;
use App\Repository\UserRepository;

$controller = new UserController(new UserRepository());
$action = $_GET['action'] ?? 'list';

switch ($action) {

    case 'search':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $users = $controller->searchUsers([
                'search' => $_POST['search'] ?? '',
        ]);
        require __DIR__ . '/View/users.php';
        exit;

    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require __DIR__ . '/View/createUsers.php';
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $controller->createUser([
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
        ]);

        header('Location: index.php');
        exit;

    case 'update':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $controller->updateUser(
            (int) ($_POST['id'] ?? 0),
            [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
            ]
        );
        header('Location: index.php');
        exit;
    
    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(400);
            exit;
        }
        
        $user = $controller->showUser((int) $_POST['id']);
        require __DIR__ . '/View/editUsers.php';
        exit;

    case 'delete':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }
        $controller->deleteUser((int) ($_POST['id'] ?? 0));
        header('Location: index.php');   
        exit;
    
    case 'list':
        $users = $controller->listUsers();
        require __DIR__ . '/View/users.php';
        exit;
        
    default:
        header('Location: index.php');
}   
