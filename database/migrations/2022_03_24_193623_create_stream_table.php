<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stream', function (Blueprint $table) {
            //建表
            $table -> increments('id');
            $table -> string('stream_name',200) -> notNull();
            
            //状态 1正常 2永久禁播 3限时禁播
            $table -> enum('status',[1,2,3]) -> notNull() -> default('1');  
            $table -> integer('permited_at') -> notNull() -> default('0');
            $table -> integer('sort') -> notNull() -> default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stream');
    }
}
