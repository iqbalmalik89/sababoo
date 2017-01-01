<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\JobRepository;
use BusinessObject\JobPost;
use BusinessObject\User;
use BusinessObject\Industry;

class JobRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('JobRepository', function(){
            return new JobRepository(new JobPost, new Industry, new User);
        });
    }
}
