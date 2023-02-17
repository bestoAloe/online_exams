<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Coursearrage;
use App\Models\Admin\Protype;
use App\Models\Admin\Course;
use DB;

class CourarrController extends Controller
{
    //已有课程
    public function courhave(Request $request){
        //已有课程
       //获取数据
        $stuid = Auth::guard('students')->user()->id;
        $courdel = new Coursearrage();

        //如果退选课程
        if ($request->method() == 'POST') {
            $course_id = $request -> get('course_id');
            //var_dump($course_id);die;    
               
            return $courdel -> dealstucoure($course_id,$stuid) ? '1' : '0';

        }else{

            $data = $courdel -> havcourse($stuid);
            //dd($data);die;
            //展示视图
            return view('coursearr.coursehave',compact('data'));
        }

    }

    //去选课
    public function selcourse(Request $request){
        //获取学院数据
        $protype = Protype::get(['id','protype_name']);
        $whatcourse = '';
        $ifsel['0'] = false;  //默认课程
        $stuid = Auth::guard('students')->user()->id;
        $courdel = new Coursearrage();
        
        //获取课程
        if ($request -> method() == 'POST') {
            //如果不是选课
            if (! $request -> get('course_id')) {
                $profession_id = $request -> only(['protype_id','profession_id']);
                $whatcourse = Course::where('profession_id',$profession_id['profession_id'])->get();  //根据专业id获取课程
                //dd($whatcourse);die;
                
                $havcourse =array_column($courdel -> havcourse($stuid) -> toArray(),'course_id'); //得到已选课程id数组
                $whatcourse_id = array_column($whatcourse -> toArray(), 'id'); //得到所有课程id数组
                //dd($havcourse);die;
                $chaji = array_diff($whatcourse_id,$havcourse);  //拿到没有选的课 id

                //给判断数组定值，默认已选
                foreach ($whatcourse_id as $key => $value) {
                    $ifsel[$value] = true;
                }
                //$ifsel = array_pad($ifsel, count($whatcourse_id)+1, true);  
                //dd($chaji);die;
                foreach ($ifsel as $key => $value) {
                    # 课程是不是在已经抽取课程安排表里
                    # whatcourse的id和havcourse对比
                    foreach ($chaji as $key2 => $value2) {
                        if ($key == $value2) {
                            $ifsel[$key] = false;
                        }
                    }
                }
            }else{
                //如果选课
                $course_id = $request -> only('course_id');

                return $courdel -> addstucoure($course_id,$stuid) ? '1' : '0';
            }
            //dd($ifsel);die;
            
        }

        return view('coursearr.selcourse',compact('protype','whatcourse','ifsel'));
    }
    
    //专业id获取
    public function getProtyId(Request $request){
        $protype_id = $request -> get('protype_id');
        
        $prof = DB::table('profession') -> where('protype_id',$protype_id)->get();
        //var_dump($prof);die;
        return response() -> json($prof);
    }


    /*public function getProfeId(){
        $profession_id = $request -> get('profession_id');
        
        $whatcourse = DB::table('course') -> where('profession_id',$profession_id)->get();
        //var_dump($prof);die;
        return response() -> json($prof);
    }*/
}
