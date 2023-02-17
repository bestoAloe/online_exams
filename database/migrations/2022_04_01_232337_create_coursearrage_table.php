<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursearrageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    //课程安排表
    public function up()
    {
        Schema::create('coursearrage', function (Blueprint $table) {
            $table->increments('id');
            //所属课程id
            $table->tinyInteger('course_id') -> notNull();
            //上课老师id
            $table->string('manager_id') -> notNull();
            //学生id
            $table->string('students_id') -> notNull();
            //上课时间
            $table->string('classtime');
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
        Schema::dropIfExists('coursearrage');
    }
}
