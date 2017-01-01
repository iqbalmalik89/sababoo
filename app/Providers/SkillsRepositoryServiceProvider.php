<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BusinessObject\Skill;
use BusinessObject\UserSkill;
use App\Repositories\SkillsRepository;

class SkillsRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('SkillsRepository', function(){
            return new SkillsRepository(new Skill, new UserSkill);
        });
    }
}
