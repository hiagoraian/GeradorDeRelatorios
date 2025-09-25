<?php

namespace App\Repositories\PDO;

use App\DTOs\UserDTO;
use App\Data\Connection;
use App\Repositories\Contracts\UserRepositoryInterface;
use PDO;

class PdoUserRepository implements UserRepositoryInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getPdo();
    }

    public function findByEmail(string $email): ?UserDTO
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        
        $userData = $stmt->fetch();

        if ($userData === false) {
            return null; 
        }

        return $this->hydrateUser($userData);
    }

    public function findById(int $id): ?UserDTO
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);

        $userData = $stmt->fetch();

        if ($userData === false) {
            return null;
        }

        return $this->hydrateUser($userData);
    }

    /**
     * Cria uma instância de UserDTO a partir de dados do banco.
     *
     * @param object $userData
     * @return UserDTO
     */
    private function hydrateUser(object $userData): UserDTO
    {
        return new UserDTO(
            id: $userData->id,
            name: $userData->name,
            email: $userData->email,
            masp: $userData->masp,
            is_adm: (bool) $userData->is_adm,
            password: $userData->password
        );
    }
}