<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrofessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profession', function (Blueprint $table) {
            $table -> increments('id');  //主键
            $table -> string('profession_name',20) -> notNull();  //专业名
            $table -> tinyInteger('protype_id') -> notNull();  //专业分类id
            $table -> string('teachers_ids') -> notNull();  //老师
            $table -> string('description');  //描述
            $table -> string('cover_img');   //图片地址
            $table -> integer('view_count') -> notNull() -> default('500');  //访问量  默认500 网站中这个会是随机数
            $table -> timestamps();   //时间
            $table -> tinyinteger('sort') -> notNull() -> default('0'); //排序  默认0
            $table -> tinyinteger('duration');  //课时
            $table -> decimal('price',2,1);  //价格  共2个9，一个小数点，也就是9.9元
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profession');
    }
}
