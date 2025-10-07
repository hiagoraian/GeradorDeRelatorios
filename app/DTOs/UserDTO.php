<?php

namespace App\DTOs;

class UserDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $masp,
        public readonly ?string $phone,
        public readonly bool $is_adm,
        public readonly string $password,
    ) {}
}
