<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleasepaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('releasepaper', function (Blueprint $table) {
            $table->increments('id');
            //发布试卷id
            $table->tinyInteger('testpaper_id') -> notNull();
            //题目数量
            $table->tinyInteger('quenum') -> notNull();
            //开始时间
            $table->dateTime('perstarttime') -> notNull();
            //结束时间
            $table->dateTime('perendtime') -> notNull();
            //重做次数
            $table->tinyInteger('remakenum') -> notNull();
            //create_at和updated_at时间字段，系统自己创建
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('releasepaper');
    }
}
