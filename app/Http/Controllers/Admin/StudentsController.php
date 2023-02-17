<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Admin\Profession;

class StudentsController extends Controller
{
	//列表展示
   public function showlist(){
   	//获取数据
   	$data = Students::get();
   	//展示视图
   	return view('admin.students.showlist',compact('data'));
   }

   //添加学生
   public function add_stu(Request $request){
   	if ($request -> method() == 'POST') {
    		//接收数据 自动验证
    		$temp = $request ->except(['_token','password2']);  //除去token
    		$temp['password'] = bcrypt($temp['password']);
    		$temp['role_id'] = '3';
    		$temp['created_at'] = date('Y-m-d H:i:s',time());
    		//var_dump($temp);
    		//插入表
    		return Students::insert($temp) ? '1' : '0';
    	}else{
    		//获取数值
    		$data = Profession::get();
    	   //展示视图
    	   return view('admin.students.add_stu',compact('data'));
    	}
   }

   //删除学生
   public function del_stu($id){
   	//删除数据
   	return Students::find($id) -> delete() ? '1' : '0';
   }
}
