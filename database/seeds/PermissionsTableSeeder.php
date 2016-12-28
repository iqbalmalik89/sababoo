<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder
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
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        Permission::insert(array(
         					array('role_id' => 1, 'operation_id'=>1, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
							array('role_id' => 1, 'operation_id'=>2, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>3, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>4, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>5, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>6, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>7, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>8, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>23, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>10, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>11, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>12, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>24, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>14, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>15, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>16, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>17, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>18, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>19, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>20, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>21, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>22, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>13, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>28, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>30, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>32, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>36, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                            array('role_id' => 1, 'operation_id'=>40, 'is_allowed'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),

							));

    }
}
