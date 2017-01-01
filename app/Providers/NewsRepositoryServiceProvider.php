<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\News;
use BusinessObject\Industry;
use BusinessObject\JobPost;
use App\Data\Repositories\NewsRepository;

class NewsRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('NewsRepository', function(){
            return new NewsRepository(new News, new Industry, new JobPost);
        });
    }
}
