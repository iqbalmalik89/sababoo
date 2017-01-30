<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Data\Repositories\CompanyRepository;
use App\Models\Company;

class CompanyRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('CompanyRepository', function(){
            return new CompanyRepository(new Company);
        });
    }
}
