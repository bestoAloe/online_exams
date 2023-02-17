<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ReleasepaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //创建试卷表的需要数据
		DB::table('releasepaper') -> insert([
			'testpaper_id' => '1',
			'quenum' => '15',
			'perstarttime' => date('Y-m-d H:i:s',mktime(10,0,0,4,15,2022)),
			'perendtime' => date('Y-m-d H:i:s',mktime(12,0,0,4,15,2022)),
			'remakenum' => '2',
			'created_at' => date('Y-m-d H:i:s')
		   ]);

		DB::table('releasepaper') -> insert([
			'testpaper_id' => '2',
			'quenum' => '20',
			'perstarttime' => date('Y-m-d H:i:s',mktime(10,0,0,4,15,2022)),
			'perendtime' => date('Y-m-d H:i:s',mktime(12,0,0,4,15,2022)),
			'remakenum' => '2',
			'created_at' => date('Y-m-d H:i:s')
		   ]);

		DB::table('releasepaper') -> insert([
			'testpaper_id' => '3',
			'quenum' => '20',
			'perstarttime' => date('Y-m-d H:i:s',mktime(10,0,0,4,15,2022)),
			'perendtime' => date('Y-m-d H:i:s',mktime(12,0,0,4,15,2022)),
			'remakenum' => '2',
			'created_at' => date('Y-m-d H:i:s')
		   ]);

		DB::table('releasepaper') -> insert([
			'testpaper_id' => '4',
			'quenum' => '20',
			'perstarttime' => date('Y-m-d H:i:s',mktime(10,0,0,4,15,2022)),
			'perendtime' => date('Y-m-d H:i:s',mktime(12,0,0,4,15,2022)),
			'remakenum' => '2',
			'created_at' => date('Y-m-d H:i:s')
		   ]);
    }
}
