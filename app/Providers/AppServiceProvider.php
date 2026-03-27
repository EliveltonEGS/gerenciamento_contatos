<?php

namespace App\Providers;

use App\Repository\Contact\ContactRepository;
use App\Repository\Contact\Contracts\ContactRepositoryInterface;
use App\Repository\Person\Contracts\PersonRepositoryInterface;
use App\Repository\Person\PersonRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $binds = [
            ContactRepositoryInterface::class => ContactRepository::class,
            PersonRepositoryInterface::class => PersonRepository::class
        ];

        foreach ($binds as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
