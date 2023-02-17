<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TestAndExerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //创建试卷表的需要数据
      DB::table('testpaper') -> insert([
      	'testpaper_name' => 'php基础',
      	'course_id' => '2',
        'allexce' => '23',
      	'created_at' => date('Y-m-d H:i:s')
      	]);
      DB::table('testpaper') -> insert([
      	'testpaper_name' => '前端网页开发',
      	'course_id' => '1',
        'allexce' => '0',
      	'created_at' => date('Y-m-d H:i:s')
      	]);
      DB::table('testpaper') -> insert([
      	'testpaper_name' => '三维动画设计',
      	'course_id' => '4',
        'allexce' => '0',
      	'created_at' => date('Y-m-d H:i:s')
      	]);
      DB::table('testpaper') -> insert([
      	'testpaper_name' => '游戏程序设计',
      	'course_id' => '3',
        'allexce' => '0',
      	'created_at' => date('Y-m-d H:i:s')
      	]);

      //试题数据填充
      DB::table('exerpaper') -> insert([
      	'exerpaper_name' => '下列说法正确的是？',
      	'testpaper_id' => '1',
      	'options' => 'A.php是在服务器端执行的脚本语言~B.学php不可以建网站~C.php上线时间是1990年~D.php不是免费开源的',
      	'answer' => 'A',
      	'created_at' => date('Y-m-d H:i:s')
      	]);
      DB::table('exerpaper') -> insert([
      	'exerpaper_name' => '下列说法错误的是？',
      	'testpaper_id' => '1',
      	'options' => 'A.php是在服务器端执行的脚本语言~B.学php可以建网站~C.php上线时间是1990年~D.php是免费开源的',
      	'answer' => 'C',
      	'created_at' => date('Y-m-d H:i:s')
      	]);
      DB::table('exerpaper') -> insert([
      	'exerpaper_name' => '下列选项中哪个不是php中变量基本数据类型？？',
      	'testpaper_id' => '1',
      	'options' => 'A.布尔型boolean~B.数组array ~C.对象object~D.片段piece',
      	'answer' => 'D',
      	'created_at' => date('Y-m-d H:i:s')
      	]);
    }
}
