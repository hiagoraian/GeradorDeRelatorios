<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Repositório de Usuário (já existente)
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\PDO\PdoUserRepository;

// [NOVO] Repositório de Professor/Semestre
use App\Repositories\Contracts\ProfessorSemesterRepositoryInterface;
use App\Repositories\PDO\PdoProfessorSemesterRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            PdoUserRepository::class
        );

        $this->app->singleton(
            ProfessorSemesterRepositoryInterface::class,
            PdoProfessorSemesterRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}