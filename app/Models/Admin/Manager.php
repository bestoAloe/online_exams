<?php

namespace App\Models\Admin;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
//引入trait
use Illuminate\Auth\Authenticatable;

#Model implements \Illuminate\Contracts\Auth\Authenticatable

class Manager extends  User
{

    //定义当前模型需要关联的数据表
    protected $table = 'manager';
    //public $timestamps = false;

    //使用trait,相当于将整个trait代码段复制到这个位置
    use Authenticatable;

    //定义与角色模型的关联操作（一对一）
    public function role(){
    	return $this -> hasOne('App\Models\Admin\Role','id','role_id');
    }

}