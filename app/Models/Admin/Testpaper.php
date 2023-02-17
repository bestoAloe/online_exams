<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testpaper extends Model
{
   //定义关联的数据表
   protected $table = 'testpaper';

   //关联模型
   /*关联课程，一对一*/
   public function reatocourse(){
   	return $this -> hasOne('App\Models\Admin\Course','id','course_id');
   }
}
