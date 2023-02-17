<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson', function (Blueprint $table) {
            $table -> increments('id');  //主键
            $table -> string('lesson_name',50) -> notNull();  //上课名
            $table -> integer('course_id') -> notNull();  //属于什么课程
            $table -> integer('video_time') -> notNull();  //视频时间
            $table -> string('video_addr'); //视频地址
            $table -> integer('sort') -> notNull() -> default(0);  //排序
            $table -> string('description');   //描述
            $table -> timestamps();   //时间
            $table -> enum('status',[1,2]) -> notNull() -> default('2');  //状态
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson');
    }
}
