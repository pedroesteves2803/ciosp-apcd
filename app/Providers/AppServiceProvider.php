<?php

namespace App\Providers;

use Ciosp\Sales\Domain\Repositories\ICartsRepository;
use Ciosp\Sales\Domain\Repositories\ICustomersRepository;
use Ciosp\Sales\Domain\Repositories\IOrderItemRepository;
use Ciosp\Sales\Domain\Repositories\IProductsRepository;
use Ciosp\Sales\Infrastructure\EloquentCartsRepository;
use Ciosp\Sales\Infrastructure\EloquentCustomersRepository;
use Ciosp\Sales\Infrastructure\EloquentOrderItemRepository;
use Ciosp\Sales\Infrastructure\EloquentProductsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(IProductsRepository::class, EloquentProductsRepository::class);
        app()->bind(ICustomersRepository::class, EloquentCustomersRepository::class);
        app()->bind(ICartsRepository::class, EloquentCartsRepository::class);
        app()->bind(IOrderItemRepository::class, EloquentOrderItemRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
