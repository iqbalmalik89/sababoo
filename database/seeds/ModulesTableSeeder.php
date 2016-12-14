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
         					array('name' => 'Roles'),
							array('name' => 'Admin Users'),
							array('name' => 'Site Users'),
                            array('name' => 'Jobs'),
                            array('name' => 'Skills'),
                            array('name' => 'Industries'),
                            array('name' => 'Transactions')
							));

    }
}
