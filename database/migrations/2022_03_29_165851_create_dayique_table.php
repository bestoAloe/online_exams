<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayiqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dayique', function (Blueprint $table) {
            $table->increments('id');
            //所属课程  id 
            $table->tinyInteger('bel_course',10) -> notNull();
            //谁提的问题  id ，长度20的varchar，不能为nul
            $table->tinyInteger('ques_who',10) -> notNull();
            //角色表中的主键id  身份
            $table->tinyInteger('role_id');
            //问题
            $table->string('question') -> notNull();
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
        Schema::dropIfExists('dayique');
    }
}
