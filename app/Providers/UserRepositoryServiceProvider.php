<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Data\Repositories\UserRepository;
use App\Models\AdminUser;
use App\Models\Role;

class UserRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('UserRepository', function(){
            return new UserRepository(new AdminUser, new Role);
        });
    }
}
