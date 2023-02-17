<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Releasepaper;
use App\Models\Admin\Exerpaper; 
use App\Models\Admin\Testpaper;
use App\Models\Admin\Coursearrage;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Exeranalysis;

class ReleasepaperController extends Controller
{
    //列表展示
    public function showlist(Request $request){
        //获取用户已有课程
        $thestu_role_id = Auth::guard('admin')->user()->role_id;  //获取目前登录用户角色
        if ($thestu_role_id == '1') {
            $courdata = Coursearrage::get('course_id');  //如果不是老师可以查看所有课程
        }else{
            $thestu = Auth::guard('admin')->user()->id;   //获取目前登录管理员id
            $data0 = new Coursearrage();
            $courdata = $data0 -> adminhavcourse($thestu);
        }
        
        $courid = '';
        //如果有表单提交,获取课程id
        if ($request -> method() == 'POST') {
            $allquest = $request -> all();
            //dd($allquest);die;
            //第一次提交，获取课程id
            if(array_key_exists('course_id',$allquest)){
                $courid = $request->get('course_id');
                //var_dump($courid);die;
            }
        }
        //dd($havcourid);die;
        //获取数据
        $reledata = Releasepaper::all();
        $testdata = Testpaper::all();
        $num = 1;
        //dd($reledata);die;
        //展示视图
        return view('admin.releasepaper.showlist',compact('courdata','reledata','testdata','courid','num'));
    }
    
    //发布处理
    public function releasedeal(Request $request){
        if($request->method() == 'POST'){
            $allquest = $request -> all();
            //对试卷的操作
            if(array_key_exists('orderid',$allquest)){
                //dd($allquest);die;
                $orderid = array_shift($allquest);
                //发布试卷
                if($orderid ==  '2'){
                    //插入数据
                    $allquest['created_at'] = date('Y-m-d H:i:s');
                    //dd($allquest);die;
                    return Releasepaper::insert($allquest) ? '1' : '0';
                }

                //编辑试卷
                //$ftm['testpaper_id'] ='';
                if ($orderid == '3') {
                    # 更新数据
                    $ftm['testpaper_id'] = $allquest['testpaper_id2'];
                    $ftm['quenum'] = $allquest['quenum2'];
                    $ftm['remakenum'] = $allquest['remakenum2'];
                    $ftm['perstarttime'] = $allquest['perstarttime2'];
                    $ftm['perendtime'] = $allquest['perendtime2'];
                    //dd($allquest);die;
                    return Releasepaper::where('id',$allquest['releid'])->update($ftm) ? '1' : '0';
                }

                if($orderid == '4'){
                    //dd($allquest);die;
                    return Releasepaper::find($allquest['id'])->delete() ? '1' : '0';
                }
            }
        }
    }
     
    //作答分析
    public function answeranalysis(Request $request,$id){
        //获取发布试卷id
        $data = Exeranalysis::where('releaseid',$id)->get(['studentid','correct_rate']);

        foreach ($data as $key => $val) {
            $datainfo[$key]['stu_name'] = $val->reatostu->stu_name;
            $datainfo[$key]['correct_rate'] = $val->correct_rate;
        }
        //dd($datainfo);die;
        //获取每个学生的正确率
        //视图
        return view('admin.releasepaper.releanalysis',compact('datainfo'));
    }

    //题目的展示
    public function makethexer(Request $request,$id){
      
      //如果是第二次提交，用复原data
      $ifsecond = false;  //默认未提交
    	if ($request->method() == 'POST') {
    		$ifsecond = true;
    	}
    	//dd($ifsecond);die;

    	$queidnum = Releasepaper::where('id',$id)->get()->toArray();
      
      
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
                $data = $request->session()->pull('quedata');
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
            //dd($tolscores);die;
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
        return view('admin.releasepaper.makethexer',compact('data','id','tmp','allanwch','ifcorrect','othernum'));
    }

}
