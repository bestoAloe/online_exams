<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestpaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testpaper', function (Blueprint $table) {
            //建立试卷表
            $table -> increments('id');
            $table -> string('testpaper_name',50) -> notNull();  //试卷名称
            $table -> tinyInteger('course_id') -> notNull();  //课程id
            $table -> integer('allexce') -> notNull() -> default(0);  //题库总题数量
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testpaper');
    }
}
