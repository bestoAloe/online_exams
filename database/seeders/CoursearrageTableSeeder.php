<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CoursearrageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('coursearrage') -> insert([
        	    'course_id' => '1',
        	    'manager_id' => '5',
        	    'students_id' => '1,3,5,9,11,18,19,21,25,20,43,60,85,93',
        	    'classtime' => '每周四 10:00 - 11:45',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);
      DB::table('coursearrage') -> insert([
        	    'course_id' => '4',
        	    'manager_id' => '6',
        	    'students_id' => '1,4,5,8,13,15,19,23,25,38,47,60,70,97',
        	    'classtime' => '每周四 10:00 - 11:45',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);
      DB::table('coursearrage') -> insert([
        	    'course_id' => '3',
        	    'manager_id' => '7',
        	    'students_id' => '1,2,7,8,10,16,19,24,25,30,48,60,73,95',
        	    'classtime' => '每周四 10:00 - 11:45',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);
    }
}
