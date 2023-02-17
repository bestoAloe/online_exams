<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Coursearrage;
use App\Models\Admin\Lesson;
use App\Models\Admin\Course;
use App\Models\Admin\Live;

class ZhiboController extends Controller
{
   public function zhibo(Request $request){
   	//获取用户已有课程
		$thestu_role_id = Auth::guard('students')->user()->role_id;  //获取目前登录用户角色
		if ($thestu_role_id != '3') {
		   $courdata = Coursearrage::get('course_id');  //如果不是学生可以查看所有课程
		}else{
		   $thestu = Auth::guard('students')->user()->id;   //获取目前登录学生id

		$data0 = new Coursearrage();
		$courdata = $data0 -> havcourse($thestu);
		}

		$courid = '';
		$reladdr = '';
		$lookurl = '';
		$num = 1;
		//如果有表单提交
		if ($request -> method() == 'POST') {
			//获取课程id
		   $courid = $request->get('course_id');
		   //根据课程id获取封面、视频地址
		   $reladdr = Lesson::where('course_id',$courid) -> get();
		   $con = new Live();
		   $livecourse = Course::where('id',$courid) ->get('course_name')->toArray();
		   $lookurl = $con->deal_addr($livecourse[0]['course_name']);
		   //dd($lookurl);die; 
		}

   	//展示视图
   	return view('courzhibo.zhibo',compact('courdata','courid','reladdr','num','lookurl'));
   }
}
