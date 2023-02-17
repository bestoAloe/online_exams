<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DayiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//答疑 -  问题
      DB::table('dayique') -> insert([
        	    'bel_course' => 'php基础',
        	    'ques_who' => '5',
        	    'role_id' => '3',
        	    'question' => 'PHP中,标识符允许出现的符号有哪些？',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);
      DB::table('dayique') -> insert([
        	    'bel_course' => 'php基础',
        	    'ques_who' => '5',
        	    'role_id' => '3',
        	    'question' => 'php中，不等运算符是哪个？',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);
      DB::table('dayique') -> insert([
        	    'bel_course' => 'php基础',
        	    'ques_who' => '5',
        	    'role_id' => '3',
        	    'question' => 'PHP中,数组排序怎么排？',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);

      //答疑 - 回答
      DB::table('dayianw') -> insert([
        	    'anw_who' => '8',
        	    'role_id' => '3',
        	    'anw_show' => '大写字母',
        	    'bel_que' => '1',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);
      DB::table('dayianw') -> insert([
        	    'anw_who' => '22',
        	    'role_id' => '3',
        	    'anw_show' => '小写字母',
        	    'bel_que' => '1',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);
      DB::table('dayianw') -> insert([
        	    'anw_who' => '26',
        	    'role_id' => '3',
        	    'anw_show' => '不知道',
        	    'bel_que' => '1',
        	    'created_at' => date('Y-m-d H:i:s')   	    
        	]);
    }
}
