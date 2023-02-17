<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
   //定义当前模型需要关联的数据表
   protected $table = 'lesson';

   //关联模型
   /*课程和点播是 一对多 的关系，但是因为点播都在点播列表里，从点播角度看，课程关联专业 一对一 关系*/
   public function rea_course(){
   	return $this -> hasOne('App\Models\Admin\Course','id','course_id');
   }
}
