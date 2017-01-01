<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BusinessObject\Industry;
use BusinessObject\User;
use App\Repositories\IndustryRepository;

class IndustryRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('IndustryRepository', function(){
            return new IndustryRepository(new Industry, new User);
        });
    }
}
