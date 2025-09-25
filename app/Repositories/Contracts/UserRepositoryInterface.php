<?php

namespace App\Repositories\Contracts;
use App\DTOs\UserDTO;

interface UserRepositoryInterface
{
    /**
     * Encontra um usuário pelo seu endereço de e-mail.
     *
     * @param string $email
     * @return UserDTO|null
     */
    public function findByEmail(string $email): ?UserDTO;

    /**
     * Encontra um usuário pelo seu ID.
     *
     * @param int $id
     * @return UserDTO|null
     */
    public function findById(int $id): ?UserDTO;
}