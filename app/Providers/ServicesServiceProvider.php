<?php

namespace App\Providers;

use App\Commands\CreateBase;
use App\Commands\CreatePattern;
use App\Commands\CreateRepository;
use App\Commands\CreateRepositoryInterface;
use App\Commands\CreateService;
use App\Commands\CreateServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    protected $commands = [
        CreateBase::class,
        CreatePattern::class,
        CreateRepository::class,
        CreateRepositoryInterface::class,
        CreateService::class,
        CreateServiceInterface::class
    ];
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }


}
