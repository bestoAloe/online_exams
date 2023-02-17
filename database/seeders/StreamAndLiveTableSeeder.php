<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StreamAndLiveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //直播流的数据
       DB::table('stream') -> insert([
       	   'stream_name' => 'sh09',
       	   'status'  => '2' //2表示永久禁播
       	]);
       DB::table('stream') -> insert([
       	   'stream_name' => 'test',
       	   'status'  => '3',  //3 限时禁播
       	   'permited_at' => strtotime(date('2023-3-23 00:00:00'))
       	]);
       DB::table('stream') -> insert([
       	   'stream_name' => 'sh09',
       	   'status'  => '1' // 1 表示正常播放
       	]);

       //live表的数据
       DB::table('live') -> insert([
       	   'live_name' => 'php基础',
       	   'profession_id' => '1',
       	   'stream_id' => 3,
       	   'cover_img' => '',
       	   'description' => 'php直播课程在线学习',
       	   'begin_at' => strtotime(date('2022-3-24 00:00:00')),
       	   'end_at' => strtotime(date('2022-7-1 00:00:00'))
       	]);
       DB::table('live') -> insert([
       	   'live_name' => '前端网页开发',
       	   'profession_id' => '1',
       	   'stream_id' => 1,
       	   'cover_img' => '',
       	   'description' => '前端直播课程在线学习',
       	   'begin_at' => strtotime(date('2022-3-24 00:00:00')),
       	   'end_at' => strtotime(date('2022-7-1 00:00:00'))
       	]);
    }
}
