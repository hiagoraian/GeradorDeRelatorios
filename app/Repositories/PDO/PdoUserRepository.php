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
            phone: $userData->phone,
            is_adm: (bool) $userData->is_adm,
            password: $userData->password
        );
    }

    // Dentro da classe PdoUserRepository

    public function update(int $id, array $data): bool
    {

        $fields = [];
        foreach (array_keys($data) as $field) {
            $fields[] = "{$field} = :{$field}";
        }
        $fieldString = implode(', ', $fields);

        $data['id'] = $id;

        $sql = "UPDATE users SET {$fieldString} WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute($data);
    }

    // Dentro da classe PdoUserRepository
public function create(array $data): ?UserDTO
{
    $fields = array_keys($data);
    $fieldString = implode(', ', $fields);
    $placeholderString = ':' . implode(', :', $fields);

    $sql = "INSERT INTO users ({$fieldString}) VALUES ({$placeholderString})";

    $stmt = $this->pdo->prepare($sql);

    if ($stmt->execute($data)) {
        // Se a inserção deu certo, pegamos o ID do novo usuário
        $lastId = $this->pdo->lastInsertId();
        // e usamos nosso método findById para retornar o DTO completo
        return $this->findById((int) $lastId);
    }

    return null;
}

// Dentro da classe PdoUserRepository
public function findManyByIds(array $ids): array
{
    if (empty($ids)) {
        return [];
    }

    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "SELECT * FROM users WHERE id IN ({$placeholders})";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($ids);

    $results = $stmt->fetchAll(PDO::FETCH_OBJ);

    $dtos = [];
    foreach ($results as $userData) {
        $dtos[] = $this->hydrateUser($userData);
    }
    return $dtos;
}

public function getAllProfessors(): array
{
    $sql = "SELECT * FROM users WHERE is_adm = false ORDER BY name ASC";
    $stmt = $this->pdo->query($sql);
    
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);

    $dtos = [];
    foreach ($results as $userData) {
        $dtos[] = $this->hydrateUser($userData);
    }
    return $dtos;
}
}