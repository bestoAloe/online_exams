<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表
        Schema::create('protype', function (Blueprint $table) {
            $table -> increments('id');  //主键
            $table -> string('protype_name',20) -> notNull();  //专业分类名
            $table -> tinyInteger('sort') -> notNull() -> default('0');   //整型   排序（从大到小）
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
        Schema::dropIfExists('protype');
    }
}
