<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Releasepaper;
use App\Models\Admin\Exerpaper;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Coursearrage;

class ExerpaperController extends Controller
{  
	//考试练习
   public function exerpaperlist(Request $request){
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
        //如果有表单提交
        if ($request -> method() == 'POST') {
            $courid = $request->get('course_id');
        }
        //dd($havcourid);die;
    	//获取数据
    	$reledata = Releasepaper::get();
      $num = 1;
      //dd($num);die;
    	//展示视图
      return view('exerpaper.exerpaperlist',compact('courdata','reledata','courid','num'));
    }


    //题目的展示
    public function exepaperstu(Request $request,$id)
    {
      
      //如果是第二次提交，用复原data
      $ifsecond = false;  //默认未提交
    	if ($request->method() == 'POST') {
    		$ifsecond = true;
    	}
    	//dd($ifsecond);die;
      //dd($id);die;
    	//在发布表上获取试卷信息
    	$queidnum = Releasepaper::where('id',$id)->get()->toArray();
      
      if(!$ifsecond){
        $remakenum['remakenum']= $queidnum[0]['remakenum'];
        //重做次数-1
        if($remakenum['remakenum'] > 0){
          $remakenum['remakenum']--;
          Releasepaper::where('id',$id) -> update($remakenum);
        }
      }
      
      
      //dd($queidnum);die;
      
      //根据id获得testpaper_id
      $paperid = $queidnum[0]['testpaper_id']; 
      //题目数量
      $quenum = $queidnum[0]['quenum']; 
      //dd($quenum);die;
      
      
    	//获取题目信息
    	if (!$ifsecond) {
    		$data = new Exerpaper();
      	$data = $data->radatasea($paperid,$quenum)->toArray();
        //dd($data);die;
        if(empty($data)){ 
          //如果没有获取到数据
          exit("<h1>未找到试题!</h>");
        }
      	//将data存到session
      	$request->session()->put('quedata',$data);
      	//dd($request->session()->all());die;

    	}else{
    		//提交后进入显示原来的问题
    		if ($request->session()->has('quedata')) {
    			$data = $request->session()->get('quedata');
    			//dd($request->session()->all());die;
          $quenum = count($data);
          //dd($data);die;
         }
    	}
    	//dd($data);die;
      
    	//分离选项传值
    	$tmp[] = '';
      foreach ($data as $key => $value) {
      	$tmp[$key] = explode('~', $value['options']);
      }
      //dd($tmp);die;

    	//满分 从抽取到的题中求和 
    	foreach ($data as $key => $val) {
    		$scores[$key] = $val['score'];
    	}
    	$allscores = array_sum($scores); 
      //dd($allscores);die;

      $ifcorrect[] = '';
    	//题目是否正确，默认错误
    	for ($i=0; $i < $quenum; $i++) { 
    		$ifcorrect['inlineRadioOptions'.$i] = false;
    	}
    	//dd($ifcorrect);die;

    	//取得分数
    	$tolscores = 0;
    	//做题答案
    	$allanwch[] = '';

    	//提交试卷后
    	if ($request->method() == 'POST') {

    		$allanwch = $request->except('_token');
    		//dd($data);die;
        //dd($allanwch);die;

    		//正确答案和分数,从data数组中获取
    		foreach ($data as $key => $val) {
    			$curanswer[$key] = $val['answer'];
    		   $scores[$key] = $val['score'];
    	   }
        //更改正确答案数组键名
        $kname[] = '';
        for ($i=0; $i < count($curanswer); $i++) { 
          $kname[$i] = 'inlineRadioOptions'.$i;
        }
        $curanswer = array_combine($kname,$curanswer);
        $scores = array_combine($kname,$scores);
    		//dd($curanswer);die;

    		//批改
    		foreach ($allanwch as $key => $v) {
          if ($v == $curanswer[$key]) {
            $ifcorrect[$key] = true;
            $tolscores += $scores[$key];
          }
    		}
    		//dd($ifcorrect);die;
    	}

    	//放到一个数组里
    	$othernum['tolscores'] = $tolscores;
    	$othernum['allscores'] = $allscores;
    	$othernum['quenum'] = $quenum;
    	$othernum['ifsecond'] = $ifsecond;
      $othernum['starttime'] = $queidnum[0]['perstarttime'];
      $othernum['endtime'] = $queidnum[0]['perendtime'];
    	//dd($othernum);die;

 		//展示视图
 		return view('exerpaper.exepaperstu',compact('data','id','tmp','allanwch','ifcorrect','othernum'));
    }
}
