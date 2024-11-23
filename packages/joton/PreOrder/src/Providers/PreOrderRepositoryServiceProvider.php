<?php

namespace Joton\PreOrder\Providers;

use Illuminate\Support\ServiceProvider;
use Joton\PreOrder\Services\UserService;
use Joton\PreOrder\Services\ProductService;
use Joton\PreOrder\Services\PreOrderService;
use Joton\PreOrder\Http\Middlewares\CheckAdmin;
use Joton\PreOrder\Services\ProductCategoryService;
use Joton\PreOrder\Exceptions\CustomExceptionHandler;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Joton\PreOrder\Repositories\{AuthRepository, AuthRepositoryInterface, PreOrderRepository, PreOrderRepositoryInterface, ProductCategoryRepositoryInterface, ProductCategoryRepository, ProductRepository, ProductRepositoryInterface, UserRepository, UserRepositoryInterface};
use Joton\PreOrder\Services\AuthService;

class PreOrderRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        // Bind your custom exception handler
        $this->app->singleton(ExceptionHandler::class, CustomExceptionHandler::class);

        // Binding the repository interface to the repository implementation
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );
        $this->app->bind(
            ProductCategoryRepositoryInterface::class,
            ProductCategoryRepository::class
        );
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
        $this->app->bind(
            PreOrderRepositoryInterface::class,
            PreOrderRepository::class
        );
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        // Registering the service
        $this->app->bind(
            AuthService::class,
            AuthService::class
        );
        $this->app->bind(
            ProductCategoryService::class,
            ProductCategoryService::class
        );
        $this->app->bind(
            ProductService::class,
            ProductService::class
        );
        $this->app->bind(
            PreOrderService::class,
            PreOrderService::class
        );
        $this->app->bind(
            UserService::class,
            UserService::class
        );
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load routes, views, and other assets if needed
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');

        // // Register migrations
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        // Register the middleware alias
        $this->app['router']->aliasMiddleware('check.admin', CheckAdmin::class);
    }
}
