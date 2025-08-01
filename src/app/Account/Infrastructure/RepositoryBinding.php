<?php declare(strict_types=1);

namespace App\Account\Infrastructure;

use Illuminate\Support\ServiceProvider;

final class RepositoryBinding extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(
            abstract: \App\Account\Domain\Repository\RoleRepositoryInterface::class,
            concrete: \App\Account\Infrastructure\Repository\RoleRepository::class
        );

        $this->app->bind(
            abstract: \App\Account\Domain\Repository\UserReadRepositoryInterface::class,
            concrete: \App\Account\Infrastructure\Repository\Storage\UserStorageRepository::class
        );

        $this->app->bind(
            abstract: \App\Account\Domain\Repository\UserWriteRepositoryInterface::class,
            concrete: \App\Account\Infrastructure\Repository\Transaction\UserTransactionRepository::class
        );

        $this->app->bind(
            abstract: \App\Account\Domain\Repository\UserRepositoryInterface::class,
            concrete: \App\Account\Infrastructure\Repository\UserRepository::class
        );

        $this->app->bind(
            abstract: \App\Shared\Domain\Repository\AccountRepositoryInterface::class,
            concrete: \App\Account\Infrastructure\Repository\UserRepository::class
        );
    }
}
