<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dayianw extends Model
{
   //use HasFactory;
    //定义关联的数据表
    protected $table = 'dayianw';

    //关联学生
   public function rea_student(){
    	return $this -> hasOne('App\Models\Students','id','anw_who');
    }

    //关联老师
   public function rea_manager(){
      return $this -> hasOne('App\Models\Admin\Manager','id','anw_who');
    }
}
