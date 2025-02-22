<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\WhoisRepositoryInterface;
use App\Infrastructure\Persistence\WhoisRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(WhoisRepositoryInterface::class, WhoisRepository::class);
    }
}
