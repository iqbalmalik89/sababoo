<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
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
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        Role::insert(array(
         					array('name' => 'Super Admin', 'is_active'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
							));

    }
}
