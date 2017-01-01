<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Operation;
use App\Models\Module;
use BusinessObject\User;
use App\Repositories\RoleRepository;

class RoleRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('RoleRepository', function(){
            return new RoleRepository(new Role, new Permission, new Operation, new Module, new User);
        });
    }
}
