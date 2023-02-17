<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Exerpaper;
use App\Models\Admin\Testpaper;
//引入excel
use Excel;
use Storage;

class ExerpaperController extends Controller
{
    //列表
    public function showlist(){
    	//获取数据
    	$data = Exerpaper::get();
    	//展示视图
    	return view('admin.exerpaper.showlist',compact('data'));
    }
    
    //导出
    public function export(){
    	return Excel::download(new \App\Exports\ExerpaperModelExport(), '试题表.xlsx');
   }

   //导入数据
   public function import(Request $request){
   	if ($request->method() == 'POST') {
      //$file = $request -> all();
   		//数据的导入  通过laravel-excel导入,确定好data值
   		$filePath = $request->get('excelpath');
      $testpaperid = $request->get('testpaper_id');
      //获取数据
      $data = Excel::toArray(new \App\Imports\ExerpaperImport(),$filePath,'public');
      //var_dump($data);die;
        //读取全部数据
        $temp = [];
        foreach ($data as $value) {
          foreach ($value as $key => $value2) {
            if ($key == '0') {
              //除去表头
              continue;
            }
            $temp[] = [
             'exerpaper_name' => $value2['0'],
             'testpaper_id' => $testpaperid,
             'score' => $value2['3'],
             'options' => $value2['1'],
             'answer' => $value2['2'],
             'created_at' => date('Y-m-d H:i:s'),
            ];
          }
          
        }
        //var_dump($temp);die;
        
        $oldnum = Testpaper::where('id',$testpaperid)->get()->toArray();
        $upnum['allexce'] = count($temp)+$oldnum[0]['allexce'];
        //dd($upnum);die;

        //写入
        $resultfal = Exerpaper::insert($temp);
        //更新试卷题目数量
        $upnum = Testpaper::where('id',$testpaperid)->update($upnum);

        echo $resultfal && $upnum ? '1' : '0';   //return ajax拿不到值
   		
   	}else{
   		//获取数据
   	   $list = Testpaper::get();
   	   //展示视图
   	   return view('admin.exerpaper.import',compact('list'));
   	}
   }

}
