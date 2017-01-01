<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\RefundRepository;
use BusinessObject\JobPost;
use BusinessObject\User;
use App\Models\Refund;
use App\Models\Payment;

class RefundRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('RefundRepository', function(){
            return new RefundRepository(new JobPost, new Refund, new User, new Payment);
        });
    }
}
