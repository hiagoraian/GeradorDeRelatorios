<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    /**
     * Busca um usuário pelo seu endereço de e-mail.
     *
     * @param string $email
     * @return object|false
     */
    public function findByEmail(string $email);
}