<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ActivityLog;
use App\Models\Role;
use BusinessObject\User;
use App\Data\Repositories\ActivityLogRepository;

class ActivityLogRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('ActivityLogRepository', function(){
            return new ActivityLogRepository(new ActivityLog, new User, new Role);
        });
    }
}
