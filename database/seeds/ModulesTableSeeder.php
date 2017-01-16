<?php

use Illuminate\Database\Seeder;
use App\Models\Module;
use Carbon\Carbon;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Module::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        Module::insert(array(
         					array('name' => 'Roles Management'),
							array('name' => 'Admin Users'),
							array('name' => 'Site Users'),
                            array('name' => 'Jobs Management'),
                            array('name' => 'Skills Management'),
                            array('name' => 'Industries Management'),
                            array('name' => 'Transaction History'),
                            array('name' => 'Refund Requests'),
                            array('name' => 'Activity Logs'),
                            array('name' => 'News Management'),
                            array('name' => 'Job Disputes')
							));

    }
}
