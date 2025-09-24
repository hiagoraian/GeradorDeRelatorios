<?php

namespace App\Providers;

use App\Auth\PdoUserProvider;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Este é o código do passo anterior.
        // Ele registra seu método de login customizado.
        Auth::provider('pdo', function ($app, array $config) {
            return new PdoUserProvider(
                $app->make(UserRepositoryInterface::class),
                $app->make('hash')
            );
        });
    }
}