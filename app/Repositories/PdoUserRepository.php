<?php

namespace App\Repositories;

use App\Database\Connection;
use App\Repositories\Contracts\UserRepositoryInterface;
use PDO;

class PdoUserRepository implements UserRepositoryInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getPdo();
    }

    public function findByEmail(string $email): object|false
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        
        return $stmt->fetch();
    }
}