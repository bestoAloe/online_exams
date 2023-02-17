<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Lesson;
use App\Models\Admin\Course;
use App\Models\Admin\Protype;
use Storage;
use DB;

class LessonController extends Controller
{
    //列表
    public function showlist(){
    	//获取数据
    	$data = Lesson::orderBy('sort','desc') -> get();

    	//展示视图
    	return view('admin.lesson.showlist',compact('data'));

    }

    public function lessonadd(Request $request){
        if ($request -> method() == 'POST') {
            //判断文具是否上传成功
            $lessoninfo = $request -> except(['_token','protype_id','file','profession_id']);
            $path = $lessoninfo['excelpath'];
            $path = explode('/',$path);
            $lesname = Course::where('id',$lessoninfo['course_id'])->get('course_name')->toArray();
            //移动文件
            Storage::move('public/vedio/course/'.$path[4], 'public/vedio/course/'.$lesname[0]['course_name'].'/'.$path[4]);
            //文件路径
            $path = '../storage/vedio/course/'.$lesname[0]['course_name'].'/'.$path[4];
            $lessoninfo['video_addr'] = $path;
            unset($lessoninfo['excelpath']);
            $lessoninfo['created_at'] = date('Y-m-d H:i:s');
            //dd($lessoninfo);die;
            return Lesson::insert($lessoninfo) ? '1' : '0';
        }else{
            //二级联动
            $data = Protype::all();
            //dd($data);die;
            return view('admin.lesson.lessonadd',compact('data'));
        }
    }

    //播放方法
    public function playles(Request $request){
    	//获取播放的视频id
    	$id = $request -> get('id');
    	$addr = Lesson::where('id',$id) -> value('video_addr');
    	//播放视频
    	return "<video src='$addr' width='100%' controls='controls'> 您的浏览器不支持 video 标签。</video>";
    }

    //专业id获取
    public function getProtyId(Request $request){
        $protype_id = $request -> get('protype_id');
        
        $prof = DB::table('profession') -> where('protype_id',$protype_id)->get();
        //var_dump($prof);die;
        return response() -> json($prof);
    }
    
    //课程id获取
    public function getProfeId(Request $request){
        $profess_id = $request -> get('profession_id');
        
        $prof = DB::table('course') -> where('profession_id',$profess_id)->get();
        //var_dump($prof);die;
        return response() -> json($prof);
    }
}
