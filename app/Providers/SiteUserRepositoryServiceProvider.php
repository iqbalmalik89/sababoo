<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Data\Repositories\SiteUserRepository;
use BusinessObject\User;
use BusinessObject\Industry;
use BusinessObject\Employee;
use BusinessObject\Employer;
use BusinessObject\Tradesman;
use BusinessObject\Education;
use BusinessObject\UserSkill;
use BusinessObject\Skill;
use BusinessObject\Experience;
use BusinessObject\Language;
use BusinessObject\UserFiles;
use BusinessObject\Certification;

class SiteUserRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('SiteUserRepository', function(){
            return new SiteUserRepository(new User, new Industry, new Employee, new Employer, new Tradesman, new Education, new UserSkill, new Skill, new Experience, new Language, new UserFiles, new Certification);
        });
    }
}
