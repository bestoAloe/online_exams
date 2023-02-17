<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dayique extends Model
{
   //use HasFactory;
    //定义关联的数据表
    protected $table = 'dayique';
   
   //关联课程
   public function rea_couandayi(){
   	return $this -> hasOne('App\Models\Admin\Course','id','bel_course');
   }

   //关联学生
   public function rea_student(){
    	return $this -> hasOne('App\Models\Students','id','ques_who');
    }
    //关联老师
   public function rea_manager(){
      return $this -> hasOne('App\Models\Admin\Manager','id','ques_who');
    }
}
