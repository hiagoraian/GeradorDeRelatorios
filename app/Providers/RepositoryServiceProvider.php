<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\PDO\PdoUserRepository; 

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            PdoUserRepository::class 
        );
    }
    
}