<?php

namespace AGStore\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'AGStore\Repositories\Contracts\CategoryRepositoryInterface',
            'AGStore\Repositories\CategoryRepository'
        );

        $this->app->bind(
            'AGStore\Repositories\Contracts\ProductRepositoryInterface',
            'AGStore\Repositories\ProductRepository'
        );

        $this->app->bind(
            'AGStore\Repositories\Contracts\ImageProductRepositoryInterface',
            'AGStore\Repositories\ImageProductRepository'
        );

        $this->app->bind(
            'AGStore\Repositories\Contracts\UserRepositoryInterface',
            'AGStore\Repositories\UserRepository'
        );

        $this->app->bind(
            'AGStore\Repositories\Contracts\AddressRepositoryInterface',
            'AGStore\Repositories\AddressRepository'
        );

        $this->app->bind(
            'AGStore\Repositories\Contracts\OrderRepositoryInterface',
            'AGStore\Repositories\OrderRepository'
        );

        $this->app->bind(
            'AGStore\Repositories\Contracts\TagRepositoryInterface',
            'AGStore\Repositories\TagRepository'
        );

        $this->app->bind(
            'AGStore\Repositories\Contracts\PagSeguroTransactionRepositoryInterface',
            'AGStore\Repositories\PagSeguroTransactionRepository'
        );

        $this->app->bind(
            'AGStore\Repositories\Contracts\PagSeguroNotificationRepositoryInterface',
            'AGStore\Repositories\PagSeguroNotificationRepository'
        );

        $this->app->bind(
            'AGStore\Repositories\Contracts\ContactRepositoryInterface',
            'AGStore\Repositories\ContactRepository'
        );
    }
}
