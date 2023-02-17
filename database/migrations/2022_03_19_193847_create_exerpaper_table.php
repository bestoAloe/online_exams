<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerpaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exerpaper', function (Blueprint $table) {
            //建立习题表
            $table -> increments('id');
            $table -> string('exerpaper_name') -> notNull();  //习题名称
            $table -> tinyInteger('testpaper_id') -> notNull();  //试卷id
            $table -> tinyInteger('score') -> notNull() -> default(2);  //该题2分
            $table -> string('options') -> notNull();
            $table -> string('answer') -> notNull();
            $table -> string('remark');
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
        Schema::dropIfExists('exerpaper');
    }
}
