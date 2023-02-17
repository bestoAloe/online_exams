<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;*/
use Illuminate\Foundation\Auth\User;
//引入trait
use Illuminate\Auth\Authenticatable;

class Students extends User
{
   //定义当前模型需要关联的数据表
    protected $table = 'students';
    //public $timestamps = false;

    //使用trait,相当于将整个trait代码段复制到这个位置
    public function rea_profession(){
    	return $this -> hasOne('App\Models\Admin\Profession','id','bel_profession');
    }
}
