<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
   //定义当前模型需要关联的数据表
   protected $table = 'course';

   //关联模型
   /*专业和课程是 一对多 的关系，但是因为课程都在课程列表里，从课程角度看，课程关联专业 一对一 关系*/
   public function rea_profession(){
   	return $this -> hasOne('App\Models\Admin\Profession','id','profession_id');
   }

   //关联课程安排表
   public function rea_coursearr(){
   	return $this -> hasOne('App\Models\Admin\Coursearrage','course_id','id');
   }
}
