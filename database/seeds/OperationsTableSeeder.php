<?php

use Illuminate\Database\Seeder;
use App\Models\Operation;
use Carbon\Carbon;

class OperationsTableSeeder extends Seeder
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
        Operation::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        Operation::insert(
            array(
         		array('module_id' => 1 , 'name' => 'Create', 'route'=>"role.create", 'method'=>'POST', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 1 , 'name' => 'Update', 'route'=>"role.update", 'method'=>'PUT', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 1 , 'name' => 'Delete', 'route'=>"role.delete", 'method'=>'DELETE', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 1 , 'name' => 'List', 'route'=>"role.list", 'method'=>'GET', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),

                array('module_id' =>  2, 'name' => 'Create', 'route'=>"admin_user.create", 'method'=>'POST', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 2 , 'name' => 'Update', 'route'=>"admin_user.update", 'method'=>'PUT', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 2 , 'name' => 'Delete', 'route'=>"admin_user.delete", 'method'=>'DELETE', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 2 , 'name' => 'List', 'route'=>"admin_user.list", 'method'=>'GET', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),

                array('module_id' =>  3, 'name' => 'Create', 'route'=>"site_user.create", 'method'=>'POST', 'is_applied'=>0, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 3 , 'name' => 'Update', 'route'=>"site_user.update", 'method'=>'PUT', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 3 , 'name' => 'Delete', 'route'=>"site_user.delete", 'method'=>'DELETE', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 3 , 'name' => 'List', 'route'=>"site_user.list", 'method'=>'GET', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),

                array('module_id' =>  4, 'name' => 'Create', 'route'=>"job.create", 'method'=>'POST', 'is_applied'=>0, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 4 , 'name' => 'Update', 'route'=>"job.update", 'method'=>'PUT', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 4 , 'name' => 'Delete', 'route'=>"job.delete", 'method'=>'DELETE', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 4 , 'name' => 'List', 'route'=>"job.list", 'method'=>'GET', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),

                array('module_id' =>  5, 'name' => 'Create', 'route'=>"skills.create", 'method'=>'POST', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 5 , 'name' => 'Update', 'route'=>"skills.update", 'method'=>'PUT', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 5 , 'name' => 'Delete', 'route'=>"skills.delete", 'method'=>'DELETE', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 5 , 'name' => 'List', 'route'=>"skills.list", 'method'=>'GET', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),

                array('module_id' =>  6, 'name' => 'Create', 'route'=>"industry.create", 'method'=>'POST', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 6 , 'name' => 'Update', 'route'=>"industry.update", 'method'=>'PUT', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 6 , 'name' => 'Delete', 'route'=>"industry.delete", 'method'=>'DELETE', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 6 , 'name' => 'List', 'route'=>"industry.list", 'method'=>'GET', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),

                array('module_id' =>  7, 'name' => 'Create', 'route'=>"transaction.create", 'method'=>'POST', 'is_applied'=>0, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 7 , 'name' => 'Update', 'route'=>"transaction.update", 'method'=>'PUT', 'is_applied'=>0, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 7 , 'name' => 'Delete', 'route'=>"transaction.delete", 'method'=>'DELETE', 'is_applied'=>0, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 7 , 'name' => 'List', 'route'=>"transaction.list", 'method'=>'GET', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),

                array('module_id' =>  8, 'name' => 'Create', 'route'=>"refund.create", 'method'=>'POST', 'is_applied'=>0, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 8 , 'name' => 'Update', 'route'=>"refund.update", 'method'=>'PUT', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 8 , 'name' => 'Delete', 'route'=>"refund.delete", 'method'=>'DELETE', 'is_applied'=>0, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 8, 'name' => 'List', 'route'=>"refund.list", 'method'=>'GET', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),

                array('module_id' =>  9, 'name' => 'Create', 'route'=>"log.create", 'method'=>'POST', 'is_applied'=>0, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 9 , 'name' => 'Update', 'route'=>"log.update", 'method'=>'PUT', 'is_applied'=>0, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 9 , 'name' => 'Delete', 'route'=>"log.delete", 'method'=>'DELETE', 'is_applied'=>0, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 9, 'name' => 'List', 'route'=>"log.list", 'method'=>'GET', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),

                array('module_id' =>  10, 'name' => 'Create', 'route'=>"news.create", 'method'=>'POST', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 10 , 'name' => 'Update', 'route'=>"news.update", 'method'=>'PUT', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 10 , 'name' => 'Delete', 'route'=>"news.delete", 'method'=>'DELETE', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 10, 'name' => 'List', 'route'=>"news.list", 'method'=>'GET', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
							
                array('module_id' =>  11, 'name' => 'Create', 'route'=>"dispute.create", 'method'=>'POST', 'is_applied'=>0, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 11 , 'name' => 'Update', 'route'=>"dispute.update", 'method'=>'PUT', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 11 , 'name' => 'Delete', 'route'=>"dispute.delete", 'method'=>'DELETE', 'is_applied'=>0, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
                array('module_id' => 11, 'name' => 'List', 'route'=>"dispute.list", 'method'=>'GET', 'is_applied'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),
							));

    }
}
