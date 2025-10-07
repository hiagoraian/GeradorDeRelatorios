<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function attempt(string $email, string $password): ?UserDTO
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        Auth::loginUsingId($user->id);

        return $user;
    }
}
