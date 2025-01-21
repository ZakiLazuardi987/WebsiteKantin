<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\AuthRepositoryInterface;
use App\Repositories\DetailTransaksiRepository;
use App\Repositories\DetailTransaksiRepositoryInterface;
use App\Repositories\KategoriRepository;
use App\Repositories\KategoriRepositoryInterface;
use App\Repositories\ProdukRepository;
use App\Repositories\ProdukRepositoryInterface;
use App\Repositories\TransaksiRepository;
use App\Repositories\TransaksiRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\AuthService;
use App\Services\DetailTransaksiService;
use App\Services\FileUploadService;
use App\Services\FileUploadServiceInterface;
use App\Services\KategoriService;
use App\Services\ProdukService;
use App\Services\TransaksiService;
use App\Services\UserService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Binding Repository Interfaces ke implementasinya
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(KategoriRepositoryInterface::class, KategoriRepository::class);
        $this->app->bind(ProdukRepositoryInterface::class, ProdukRepository::class);
        $this->app->bind(TransaksiRepositoryInterface::class, TransaksiRepository::class);
        $this->app->bind(DetailTransaksiRepositoryInterface::class, DetailTransaksiRepository::class);
        
        // Binding Services
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService($app->make(AuthRepositoryInterface::class));
        });

        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(KategoriService::class, function ($app) {
            return new KategoriService($app->make(KategoriRepositoryInterface::class));
        });

        $this->app->bind(ProdukService::class, function ($app) {
            return new ProdukService($app->make(ProdukRepositoryInterface::class));
        });

        $this->app->bind(TransaksiService::class, function ($app) {
            return new TransaksiService(
                $app->make(TransaksiRepositoryInterface::class),
                $app->make(DetailTransaksiRepositoryInterface::class)
            );
        });

        $this->app->bind(DetailTransaksiService::class, function ($app) {
            return new DetailTransaksiService(
                $app->make(DetailTransaksiRepositoryInterface::class)
            );
        });

        $this->app->bind(FileUploadServiceInterface::class, FileUploadService::class);
    }

    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
