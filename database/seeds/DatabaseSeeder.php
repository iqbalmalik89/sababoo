<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//$this->call(RolesTableSeeder::class);
    	$this->call(ModulesTableSeeder::class);
    	$this->call(OperationsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
    }
}
