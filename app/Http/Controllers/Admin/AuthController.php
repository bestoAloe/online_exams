<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//引入模型
use App\Models\Admin\Auth;
//引入DB
use DB;

class AuthController extends Controller
{
    //列表
   public function showlist(Request $request){
      if ($request -> method() == 'POST') {
         $tmp = $request -> only('id');
         //dd($tmp);die;
         return Auth::find($tmp['id']) -> delete() ? '1' : '0';
      }
   	//连表查询数据
   	//SELECT t1.*,t2.auth_name AS parent_name FROM auth AS t1 LEFT JOIN auth AS t2 ON t1.pid = t2.id;
   	$data = DB::table('auth as t1') -> select('t1.*','t2.auth_name as parent_name') -> leftJoin('auth as t2','t1.pid','=','t2.id')->get();
   	return view('admin.auth.showlist',compact('data'));
   }

   //添加
   public function addau(Request $request){
   	//判断请求类型
   	if ($request->method() == 'POST'){
   		//处理数据
   		//如果需要验证数据可以仿照之前的规则去实现验证
   		//接收数据
   		$data = $request->except('_token');
   		$result = Auth::insert($data);
   		//由于框架自身不支持响应bool值，所以转化一种形式
   		return $result ? '1' : '0';
   	}else{
   		//查询父级权限
   		$parents = Auth::where('pid','=','0') -> get();
   		//展示视图
   		return view('admin.auth.addau',compact('parents'));
   	}
   	
   }

   //编辑
   public function edit_auth(Request $request,$id){
      //判断请求类型
      if ($request->method() == 'POST'){
         //处理数据
         //如果需要验证数据可以仿照之前的规则去实现验证
         //接收数据
         $data = $request->except('_token');
         //dd($data);die;
         $result = Auth::where('id',$id)->update($data);
         //由于框架自身不支持响应bool值，所以转化一种形式
         return $result ? '1' : '0';
      }else{
         //获取现有数据
         $data = Auth::where('id',$id) -> get() -> toArray();
         //dd($data);die;
         //查询父级权限
         $parents = Auth::where('pid','=','0') -> get();
         //展示视图
         return view('admin.auth.edit_auth',compact('parents','id','data'));
      }
   }

}
