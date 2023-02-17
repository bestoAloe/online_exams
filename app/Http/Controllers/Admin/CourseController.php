<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Course;
use App\Models\Admin\Protype;
use DB;

class CourseController extends Controller
{
    //列表
    public function showlist(){
    	//获取数据
    	$data = Course::orderBy('sort','desc') ->get();
        //dd($data);die;
    	//展示视图
    	return view('admin.course.showlist',compact('data'));
    }

    public function courseadd(Request $request){
    	if ($request -> method() == 'POST') {
    		//判断文具是否上传成功
    		$courseinfo = $request -> except(['_token','protype_id','file']);
    		$path = $courseinfo['excelpath'];
    		$path = explode('/',$path);
    		$path = 'storage/image/course/'.$path[4];
    		$courseinfo['cover_img'] = $path;
    		unset($courseinfo['excelpath']);
    		$courseinfo['created_at'] = date('Y-m-d H:i:s');
    		//dd($courseinfo);die;
    		return Course::insert($courseinfo) ? '1' : '0';
    	}else{
    		//二级联动
	    	$data = Protype::all();
	    	//dd($data);die;
	    	return view('admin.course.courseadd',compact('data'));
    	}
    }

    //专业id获取
    public function getProtyId(Request $request){
        $protype_id = $request -> get('protype_id');
        
        $prof = DB::table('profession') -> where('protype_id',$protype_id)->get();
        //var_dump($prof);die;
        return response() -> json($prof);
    }
    
}
