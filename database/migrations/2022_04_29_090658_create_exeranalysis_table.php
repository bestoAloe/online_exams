<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExeranalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exeranalysis', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('studentid') -> notNull(); //学生id

            $table->integer('releaseid');  //发布试卷id

            $table->string('exerpaperids') -> notNull();   //题目ids
            $table->string('stu_anwser');   //学生答案
            $table->string('correct_rate',20)-> notNull();   //试卷正确率
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
        Schema::dropIfExists('exeranalysis');
    }
}
