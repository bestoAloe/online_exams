<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Role;
use App\Models\Admin\Auth;

class RoleController extends Controller
{
   //角色列表
   public function showlist(Request $request){
      if ($request -> method() == 'POST') {
         $tmp = $request -> only('id');
         return Role::find($tmp['id']) -> delete() ? '1' : '0';
      }
   	//查取数据
   	$data = Role::get();
   	//展示视图
   	return view('admin.role.showlist',compact('data'));
   }

   public function roleadd(Request $request){
      if ($request -> method() == 'POST') {
         $data = $request -> except('_token');
         //var_dump($data);die;
         return Role::insert($data) ? '1' : '0';
      }
      return view('admin.role.roleadd');
   }


   //添加权限
   public function assign(Request $request){
   	if($request->method() == 'POST'){
   		//接收数据
   		$data = $request->only(['id','auth_id']);
   		//交给模型处理数据
   		$role = new Role();
   		//输出返回结果
   		return $role -> assignAuth($data);
   	}else{
   	  //查询一级权限
   	  $top = Auth::where('pid','==','0') -> get();
   	  //查询二级权限
   	  $cat = Auth::where('pid','!=','0') -> get();
   	  //获取当前角色具备的权限id集合
   	  $ids = Role::where('id',$request->get('id'))->value('auth_ids');
   	  //展示视图
   	  return view('admin.role.assign',compact('top','cat','ids'));
   	}
   }

}
