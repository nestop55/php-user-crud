<?php

namespace App\Repository;

use App\Database\Connector;
use App\Model\User;
use PDO;

class UserRepository
{
    public function findAll(): array
    {
        $pdo = Connector::connect();
        $stmt = $pdo->query('SELECT * FROM users ORDER BY id ASC');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $pdo = Connector::connect();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function save(User $user): void
    {
        $pdo = Connector::connect();
        $stmt = $pdo->prepare(
            'INSERT INTO users (name, email) VALUES (?, ?)'
        );

        $stmt->execute([
            $user->getName(),
            $user->getEmail(),
        ]);
    }

    public function update(User $user): void
    {
        $pdo = Connector::connect();
        $stmt = $pdo->prepare(
            'UPDATE users SET name = ?, email = ? WHERE id = ?'
        );

        $stmt->execute([
            $user->getName(),
            $user->getEmail(),
            $user->getId(),
        ]);
    }

    public function delete(int $id): void
    {
        $pdo = Connector::connect();
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);
    }
}
