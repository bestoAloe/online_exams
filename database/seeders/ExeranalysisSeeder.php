<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ExeranalysisSeeder extends Seeder
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

        //字段数据
        for ($i=0,$ids[0]=0; $i < 200; $i++) { 

        	for ($m=0,$f=0; $m < mt_rand(10,20); $m++) { 
        		$f = rand(1,23);
        		$ids[$m] = $f;
        	}
        	sort($ids,1);
        	$ss = array_unique($ids);

        	$anwsers = array('1'=>'A','2'=>'B','3'=>'C','4'=>'D');
        	
        	for ($m=0,$af = 0; $m < count($ss); $m++) { 
        		$af = mt_rand(1,4);
        		$stu_anwser[$m] = $anwsers[$af];
        	}

        	$ids = implode(',',$ss);  //字符串ids
        	$stu_anwser = implode(',',$stu_anwser);  //字符串答案

        	$cor = ($faker->randomDigit()*10+$faker->randomDigit()) / 100 ;

        	$data[] = [
        	    'studentid' =>  mt_rand(1,100),
        	    'releaseid' =>  mt_rand(1,10),
        	    'exerpaperids' =>  $ids,
        	    'stu_anwser' =>  $stu_anwser,
        	    'correct_rate' =>  $cor,
        	    'created_at' =>  date('Y-m-d H-i-s'),
        	];

        	unset($ids);
        	unset($stu_anwser);
        }
        DB::table('exeranalysis') -> insert($data);
    }
}
