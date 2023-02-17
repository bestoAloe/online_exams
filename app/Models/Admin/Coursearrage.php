<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursearrage extends Model
{
   //定义关联的数据表
    protected $table = 'coursearrage';

   //关联模型
   /*课程安排和课程是 一对多 的关系，但是因为课程都在课程列表里，从课程角度看，课程关联专业 一对一 关系*/
   public function reathecourse(){
   	return $this -> hasOne('App\Models\Admin\Course','id','course_id');
   }
   
   //关联上课老师
   public function reacourther(){
   	return $this -> hasOne('App\Models\Admin\Manager','id','manager_id');
   }


   //查看老师有哪些课
   public function adminhavcourse($adminid){
      //获取有哪些课程
      $data = self::where('manager_id',$adminid) -> get(); //id在字符首位
      if (count($data) == 0) {
         $data = self::where('manager_id','like','%,'.$adminid) -> get(); //id在字符末尾
         if (count($data) == 0) {
           $data = self::where('manager_id','like','%,'.$adminid.',%') -> get(); //id在字符中间
         }
      }
      //dd($data);die;
      return $data;
   }

   //查看学生有哪些课
   public function havcourse($stuid){
   	//获取有哪些课程
      $data = self::where('students_id','like',$stuid.',%') -> get(); //id在字符首位
      //dd(count($data));die;
      if (count($data) == 0) {
			$data = self::where('students_id','like','%,'.$stuid) -> get(); //id在字符末尾
			if (count($data) == 0) {
			  $data = self::where('students_id','like','%,'.$stuid.',%') -> get(); //id在字符中间
			}
      }
      //dd(count($data));die;
      //dd($data);die;
      return $data;
   }

   //学生选课
   public function addstucoure($course_id,$stu_id){
   	$tmp = self::where('course_id',$course_id)->get('students_id')->toArray();
   	$tmp = explode(',', $tmp[0]['students_id']);
   	//var_dump($tmp);die;
      array_unshift($tmp,$stu_id);
   	$stu['students_id'] = implode(',',$tmp); //得到字符串
   	//var_dump($stu);die;
   	return self::where('course_id',$course_id)->update($stu);
   }

     //学生退课
   public function dealstucoure($course_id,$stu_id){
      $tmp = self::where('course_id',$course_id)->get('students_id')->toArray();
      $tmp = explode(',', $tmp[0]['students_id']);
      //var_dump($tmp);die;
      array_splice($tmp,array_search($stu_id, $tmp),1);
      $stu['students_id'] = implode(',',$tmp); //得到字符串
      //var_dump($stu);die;
      return self::where('course_id',$course_id)->update($stu);
   }

}
