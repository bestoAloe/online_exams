<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//引入答疑用到的数据库
use App\Models\Admin\Coursearrage;
use App\Models\Students;
use App\Models\Admin\Course;
use App\Models\Admin\manager;
use App\Models\Admin\Dayianw;
use App\Models\Admin\Dayique;

class CoursedayiController extends Controller
{
   //课程答疑
   public function coursedayi(Request $request){
   	//获取课程数据
		//$theadmina = '8';   //暂时
		$thestu_role_id = Auth::guard('students')->user()->role_id;  //获取目前登录用户角色
		if ($thestu_role_id != '3') {
			$data = Coursearrage::get('course_id');  //如果不是学生可以查看所有课程
		}else{
			$thestu = Auth::guard('students')->user()->id;   //获取目前登录学生id
         
         $data0 = new Coursearrage();
         $data = $data0 -> havcourse($thestu);
		}

		$selvel = 0;
		//如果有表单提交
		if ($request->method() == 'POST') {
			//获取所属课程答疑数据
			$courid = $request->get('course_id');
			//获取数据
			/*a 问题表得到所属课程的问题和提问者角色，展示; 
	        b 回答表根据问题id得到姓名角色和回答,展示；*/
	      $getque = Dayique::where('bel_course','=',$courid) ->orderBy('id','desc') ->get();
	      //var_dump($getque);die;
	      $getanw = Dayianw::get();
	      $selvel = $courid;
		}else{
			$getque = array();
			$getanw = array();
		}

	   //展示视图
	   return view('coursedayi.dayilist',compact('data','getque','getanw','selvel'));
   }


   //添加回答
	public function writeanw(Request $request){
		if ($request->method('POST')) {
			$add_anw = $request->except('_token');
			$add_anw['anw_who'] = Auth::guard('students')->user()->id;
			$add_anw['role_id'] = Auth::guard('students')->user()->role_id;
			$add_anw['created_at'] = date('Y-m-d H:i:s',time());
			//var_dump($add_anw);die;
			return Dayianw::insert($add_anw) ? '1' : '0';
		}else{
			return '0';
		}
	}
    
   //添加问题
	public function dayi_add(Request $request){
		if ($request->method('POST')) {
			$add_que = $request->except('_token');
			$add_que['ques_who'] = Auth::guard('students')->user()->id;
			$add_que['role_id'] = Auth::guard('students')->user()->role_id;
			$add_que['created_at'] = date('Y-m-d H:i:s',time());
			return Dayique::insert($add_que) ? '1' : '0';
		}else{
			return '0';
		}
	}

}
