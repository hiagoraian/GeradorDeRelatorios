<?php

namespace App\Auth;

use App\DTOs\UserDTO;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Auth\GenericUser;

class PdoUserProvider implements UserProvider
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected Hasher $hasher
    ) {}

    public function retrieveById($identifier): ?Authenticatable
    {
        $userDto = $this->userRepository->findById($identifier);

        if ($userDto) {
            return $this->getAuthenticatable($userDto);
        }

        return null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        return $this->hasher->check(
            $credentials['password'],
            $user->getAuthPassword()
        );
    }
    
    protected function getAuthenticatable(UserDTO $userDto): Authenticatable
    {
        $attributes = [
            'id' => $userDto->id,
            'name' => $userDto->name,
            'email' => $userDto->email,
            'password' => $userDto->password,
            'is_adm' => $userDto->is_adm,
            'masp' => $userDto->masp,
        ];
        
        return new GenericUser($attributes);
    }

    public function retrieveByCredentials(array $credentials) { return null; }
    public function retrieveByToken($identifier, $token) { return null; }
    public function updateRememberToken(Authenticatable $user, $token) {}
}