<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerpaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answerpaper', function (Blueprint $table) {
            //答题卡建表
            $table -> increments('id');
            $table -> tinyInteger('testpaper_id') -> notNull();  //试卷id
            $table -> tinyInteger('exerpaper_id') -> notNull();  //习题id
            $table -> tinyInteger('member_id') -> notNull();  //
            $table -> enum('is_correct',[1,2]) -> notNull() -> default('2');  //是否正确
            $table -> tinyInteger('score') -> notNull() -> default(0);  //得分
            $table -> string('answer',1) -> notNull();  //答案
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
        Schema::dropIfExists('answerpaper');
    }
}
