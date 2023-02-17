<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_students', function (Blueprint $table) {
           //主键
            $table->increments('id');

            //用户名，长度20的varchar，不能为nul
            $table->string('stu_name',20) -> notNull();

            //密码，varchar(255),不能为null
            $table->string('password') -> notNull();

            //性别，1-男 2-女 3-保密
            $table->enum('gender',[1,2,3]) -> notNull() ->default('1');

            //手机号，varchar(11)
            $table->string('mobile',11);

            //邮箱，varchar(50)
            $table->string('email',40);

            //所属专业
            $table->string('bel_profession') -> notNull();

            //角色表中的主键id
            $table->tinyInteger('role_id');

            //create_at和updated_at时间字段，系统自己创建
            $table->timestamps();

            //实现记住登录状态的字段，用于存储token
            $table->rememberToken();
            
            //账号状态  1-禁用 2-启动
            $table->enum('status',[1,2]) -> notNull() -> default('2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_students');
    }
}
