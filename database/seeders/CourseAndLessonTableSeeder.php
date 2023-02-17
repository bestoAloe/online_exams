<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CourseAndLessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //创建course 和 lesson 数据表的模拟数据
       //course
        DB::table('course') -> insert([
        	    'course_name' => '前端网页开发',
        	    'profession_id' => '1',
        	    'cover_img' => 'NUll',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);
        DB::table('course') -> insert([
        	    'course_name' => 'php基础',
        	    'profession_id' => '1',
        	    'cover_img' => 'NUll',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);
        DB::table('course') -> insert([
        	    'course_name' => '游戏程序设计',
        	    'profession_id' => '1',
        	    'cover_img' => 'NUll',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);
        DB::table('course') -> insert([
        	    'course_name' => '三维动画制作',
        	    'profession_id' => '1',
        	    'cover_img' => 'NUll',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);

        //lesson填充
        DB::table('lesson') -> insert([
        	    'lesson_name' => '网页开发初识',
        	    'course_id' => '1',
        	    'video_addr' => 'NULL',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'video_time' => 86400   // = 24*60*60   一天
        	]);
        DB::table('lesson') -> insert([
        	    'lesson_name' => 'php语言初识',
        	    'course_id' => '2',
        	    'video_addr' => 'NULL',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'video_time' => 86400  	    
        	]);
        DB::table('lesson') -> insert([
        	    'lesson_name' => 'php语法',
        	    'course_id' => '2',
        	    'video_addr' => 'NULL',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'video_time' => 86400  	    
        	]);
        DB::table('lesson') -> insert([
        	    'lesson_name' => '游戏设计初识',
        	    'course_id' => '3',
        	    'video_addr' => 'NULL',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'video_time' => 86400  	    
        	]);
        DB::table('lesson') -> insert([
        	    'lesson_name' => '三维动画hp语言初识',
        	    'course_id' => '4',
        	    'video_addr' => 'NULL',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'video_time' => 86400  	    
        	]);
    }
}
