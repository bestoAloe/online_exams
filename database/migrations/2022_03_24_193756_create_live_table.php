<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live', function (Blueprint $table) {
            //建表
            $table -> increments('id');
            $table -> string('live_name',50) -> notNull() -> unique();  //直播课程名称
            $table -> integer('profession_id') -> notNull();  //所属专业
            $table -> integer('stream_id') -> notNull();  //流名称
            $table -> string('cover_img') -> notNull();
            $table -> integer('sort') -> notNull() -> default(0);
            $table -> string('description');
            $table -> integer('begin_at') -> notNull();
            $table -> integer('end_at') -> notNull();
            $table -> string('video_addr');   //录播地址
            $table -> timestamps();
            $table -> enum('status',[1,2]) -> notNull() -> default('1'); //状态
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live');
    }
}
