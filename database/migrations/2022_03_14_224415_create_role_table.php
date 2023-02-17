<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表
        Schema::create('role', function (Blueprint $table) {
            $table -> increments('id');  //主键
            $table -> string('role_name',20) -> notNull();
            $table -> text('auth_ids');
            $table -> text('auth_ac');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删表
        Schema::dropIfExists('role');
    }
}
