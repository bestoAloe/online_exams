<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProtypeAndProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //创建profession数据表的模拟数据
        DB::table('profession') -> insert([
        	    'profession_name' => '数字媒体技术',
        	    'protype_id' => '1',
        	    'teachers_ids' => '5,8,9,11,15',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'duration' => 18,
        	    'cover_img' => 'NUll',
        	    'price' => '5.9'
        	]);
        DB::table('profession') -> insert([
        	    'profession_name' => '传播学',
        	    'protype_id' => '1',
        	    'teachers_ids' => '5,8,9,11,15',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'duration' => 18,
        	    'cover_img' => 'NUll',
        	    'price' => '5.9'
        	]);
        DB::table('profession') -> insert([
        	    'profession_name' => '人工智能',
        	    'protype_id' => '2',
        	    'teachers_ids' => '5,8,9,11,15',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'duration' => 18,
        	    'cover_img' => 'NUll',
        	    'price' => '5.9'
        	]);
        DB::table('profession') -> insert([
        	    'profession_name' => '电气自动化',
        	    'protype_id' => '2',
        	    'teachers_ids' => '5,8,9,11,15',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'duration' => 18,
        	    'cover_img' => 'NUll',
        	    'price' => '5.9'
        	]);
        DB::table('profession') -> insert([
        	    'profession_name' => '信息对抗',
        	    'protype_id' => '3',
        	    'teachers_ids' => '4,7,10',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'duration' => 18,
        	    'cover_img' => 'NUll',
        	    'price' => '5.9'
        	]);
        DB::table('profession') -> insert([
        	    'profession_name' => '密码研究',
        	    'protype_id' => '3',
        	    'teachers_ids' => '18,19',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'duration' => 18,
        	    'cover_img' => 'NUll',
        	    'price' => '5.9'
        	]);
        DB::table('profession') -> insert([
        	    'profession_name' => '品牌设计',
        	    'protype_id' => '4',
        	    'teachers_ids' => '12,14',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'duration' => 18,
        	    'cover_img' => 'NUll',
        	    'price' => '5.9'
        	]);
        DB::table('profession') -> insert([
        	    'profession_name' => '工业设计',
        	    'protype_id' => '4',
        	    'teachers_ids' => '16,19',
        	    'created_at' => date('Y-m-d H:i:s'),
        	    'duration' => 18,
        	    'cover_img' => 'NUll',
        	    'price' => '5.9'
        	]);
    }
}
