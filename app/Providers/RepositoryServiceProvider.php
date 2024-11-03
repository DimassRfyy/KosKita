<?php

namespace App\Providers;

use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Repositories\CityRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Repositories\BoardingHouseRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(BoardingHouseRepositoryInterface::class, BoardingHouseRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
