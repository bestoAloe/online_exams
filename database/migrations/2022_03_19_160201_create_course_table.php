<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table -> increments('id');  //主键
            $table -> string('course_name',30) -> notNull();  //课程名
            $table -> integer('profession_id') -> notNull();  //属于什么专业
            $table -> string('cover_img'); //封面
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
        Schema::dropIfExists('course');
    }
}
