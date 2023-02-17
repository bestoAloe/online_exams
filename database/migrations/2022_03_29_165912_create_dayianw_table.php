<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayianwTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dayianw', function (Blueprint $table) {
            $table->increments('id');
            //谁的回答，长度20的varchar，不能为nul
            $table->tinyInteger('anw_who',10) -> notNull();
            //角色表中的主键id  身份
            $table->tinyInteger('role_id');
            //问题
            $table->string('anw_show') -> notNull();
            //所属问题
            $table->tinyInteger('bel_que',10) -> notNull();
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
        Schema::dropIfExists('dayianw');
    }
}
