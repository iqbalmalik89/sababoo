<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Data\Repositories\DisputeRepository;
use BusinessObject\JobPost;
use BusinessObject\User;
use App\Models\Dispute;

class DisputeRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('DisputeRepository', function(){
            return new DisputeRepository(new JobPost, new Dispute, new User);
        });
    }
}
