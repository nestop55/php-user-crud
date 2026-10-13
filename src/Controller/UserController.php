<?php

namespace App\Controller;

use App\Model\User;
use App\Repository\UserRepository;
use InvalidArgumentException;

class UserController
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listUsers(): array
    {
        return $this->repository->findAll();
    }

    public function showUser(int $id): ?array
    {
        return $this->repository->findById($id);
    }

    public function createUser(array $data): void
    {
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');

        if ($name === '' || $email === '') {
            throw new InvalidArgumentException('Nombre y email son obligatorios');
        }

        $user = new User(0, $name, $email);
        $this->repository->save($user);
    }

    public function updateUser(int $id, array $data): void
    {
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');

        if ($name === '' || $email === '') {
            throw new InvalidArgumentException('Nombre y email son obligatorios');
        }

        $user = new User($id, $name, $email);
        $this->repository->update($user);
    }

    public function deleteUser(int $id): void
    {
        $this->repository->delete($id);
    }
}
