<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Testpaper;
use App\Models\Admin\Course;

class TestpaperController extends Controller
{
	//列表方法
	public function showlist(){
		//获取数据
		$data = Testpaper::get();
		//展示视图
		return view('admin.testpaper.showlist',compact('data'));
	}

	public function addtest(Request $request){
		if ($request->method() == 'POST') {
			$tmp = $request->except('_token');
			$tmp['created_at'] = date('Y-m-d H:i:s');
			//dd($tmp);die;

			return Testpaper::insert($tmp) ? '1' : '0';

		}else{
			$data = Course::get();
			//dd($data);die;
			return view('admin.testpaper.addtest',compact('data'));
		}
	}
}
