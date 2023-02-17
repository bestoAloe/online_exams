<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //产生faker实例
    	$faker = \Faker\Factory::create('zh_CN');


      //填充模拟数据,创建学员
      for ($val=0; $val < 175; $val++) { 
      	$chinfirst = $faker -> firstname;
      	$chinlast = $faker -> lastname;

      	$data[] = [
      	   'stu_name'   =>  $chinlast.$chinfirst,
    	      'password'   =>  bcrypt('123456'), //用户密码加密函数
    	      'gender'     =>  rand(1,3),
    	      'mobile'     =>  $faker -> phoneNumber,
    	      'email'      =>  $faker -> email,
    	      'bel_profession' => rand(1,8),
    	      'role_id'    =>  '3',
    	      'created_at' =>  date('Y-m-d H:i:s',time()),
    	      'status'     =>  rand(1,2)  //账号状态
      	];
      }

      //写入数据库
      DB::table('students') -> insert($data);
   }
}
