<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\ReportRepository;
use BusinessObject\User;

class ReportRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ReportRepository', function(){
            return new ReportRepository(new User);
        });
    }
}
