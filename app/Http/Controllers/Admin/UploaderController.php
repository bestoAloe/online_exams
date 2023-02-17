<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

class UploaderController extends Controller
{
	//test uploae docement
    public function uploadpic(Request $request){
        if($request->hasFile('file') && $request->file('file')->isValid()){
            //重命名
            $name = $request->file('file')->getClientOriginalName();
            /*$extension = $request->file('file')->extension();
            $allname = $name.'.'.$extension;*/
            //添加课程
            $path = $request->file('file')->storeAs('public/image/course',$name);

            $msg = [
               'code' => 1,
               'msg' => '上传成功',
               'path' => 'storage/' . $path,
            ];
        }else{
            $msg = [
              'code' => 0,
              'msg' => $request->file('file')->getErrorMessage(),
            ];
        }

        return response()->json($msg);
    }

    public function uploadvid(Request $request){
        if($request->hasFile('file') && $request->file('file')->isValid()){
            //文件名不变
            $name = $request->file('file')->getClientOriginalName();
            /*$extension = $request->file('file')->extension();
            $allname = $name.'.'.$extension;*/
            //添加课程
            $path = $request->file('file')->storeAs('public/vedio/course',$name);

            $msg = [
               'code' => 1,
               'msg' => '上传成功',
               'path' => 'storage/' . $path,
            ];
        }else{
            $msg = [
              'code' => 0,
              'msg' => $request->file('file')->getErrorMessage(),
            ];
        }

        return response()->json($msg);
    }

    //上传文件的处理
    public function webuploader(Request $request){
    	//判断文件是否上传成功
    	if ($request -> hasFile('file') && $request->file('file')->isValid()) {
    		# c有文件上传
    		# 重命名文件  这里可以用md5
    		/*$filename = sha1(time() . $request -> file('file') -> getClientOriginalName()) . '.'.$request -> file('file') -> getClientOriginalExtension();*/
            //die();
    		#文件保存。/移动  
            $path = $request->file('file')->store('excelfile', 'public');  //方法二
    	   /*Storage::disk('public')->put($filename,file_get_contents($request -> file('file') -> path()));  //方法一：put保存数据，需要文件名+文件内容+文件路径*/

    		# 返回数据
    		$result = [
    		   'errCode' => '0',
    		   'errMsg' => '',
    		   'succMsg' => '文件上传成功',
               'path' => $path,
    		];
    		//'path' => Storage::disk('public')->getDriver()->downloadUrl($filename),
    	}else{
    		//没有文件或文件上传失败
    		$result = [
    		   'errCode' => '000001',
    		   'errMsg' => $request -> file('file') -> getErrorMessage()
    		];
    	}
    	//$path = $request->file('avatar')->store('avatars');
    	return response() -> json($result);
    }
}
