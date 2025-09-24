<?php

namespace App\Auth;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Auth\GenericUser;

class PdoUserProvider implements UserProvider
{
    protected UserRepositoryInterface $users;
    protected Hasher $hasher;

    public function __construct(UserRepositoryInterface $users, Hasher $hasher)
    {
        $this->users = $users;
        $this->hasher = $hasher;
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials['email'])) {
            return null;
        }

        $user = $this->users->findByEmail($credentials['email']);

        if ($user) {
            return new GenericUser((array) $user);
        }

        return null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        $plain = $credentials['password'];
        return $this->hasher->check($plain, $user->getAuthPassword());
    }
    
    // Os métodos abaixo não são usados para login, mas a interface exige.
    public function retrieveById($identifier) { return null; }
    public function retrieveByToken($identifier, $token) { return null; }
    public function updateRememberToken(Authenticatable $user, $token) {}
}