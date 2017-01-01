<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Payment;
use BusinessObject\User;
use BusinessObject\JobPost;
use App\Repositories\TransactionRepository;

class TransactionRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('TransactionRepository', function(){
            return new TransactionRepository(new Payment, new User, new JobPost);
        });
    }
}
