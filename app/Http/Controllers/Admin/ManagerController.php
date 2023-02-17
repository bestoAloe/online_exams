<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//引入模型
use App\Models\Admin\Manager;
use App\Models\Admin\Role;

class ManagerController extends Controller
{
    //管理员列表
    public function showlist(){
    	//查询数据
    	$data = Manager::all();
    	//展示视图
    	return view('\admin\manager\showlist',compact('data'));  //注意 compact('data')  等于 ['data' => $data]
    }

    public function add_admin(Request $request){
    	if ($request -> method() == 'POST') {
    		//接收数据 自动验证
    		$temp = $request ->except(['_token','password2']);  //除去token
    		$temp['password'] = bcrypt($temp['password']);
    		$temp['created_at'] = date('Y-m-d H:i:s',time());
    		//var_dump($temp);
    		//插入表
    		return Manager::insert($temp) ? '1' : '0';
    	}else{
    	   //查询数据
    	   $data = Role::get(['id','role_name']);
    	   //展示视图
    	   return view('admin.manager.add_admin',compact('data'));
    	}
    }

    public function edit_admin(Request $request,$id){
        if ($request -> method() == 'POST') {
            //接收数据 自动验证
            $oldpass = Manager::where('id',$id)-> get('password')->toArray();
            $temp = $request ->except(['_token','password2']);  //除去token
            if ($temp['password'] != $oldpass[0]['password']) {
                $temp['password'] = bcrypt($temp['password']);
            }
            //dd($oldpass);die;
            //更新表
            return Manager::where('id',$id)->update($temp) ? '1' : '0';
        }else{
           //查询数据
           $data = Manager::where('id',$id)-> get()->toArray();
           $roledata = Role::get(['id','role_name']);
           //dd($data);die;
           //展示视图
           return view('admin.manager.edit_admin',compact('roledata','data','id'));
        }
    }

    public function deal_admin($id,Request $request){
      $orderid = $request -> only('orderid');
      //var_dump($orderid);die;

      //停用
      if ($orderid['orderid'] == '1') {
          $change['status'] = 1;
          return Manager:: where('id',$id) -> update($change) ? '1' : '0';
      }

      //启用
      if ($orderid['orderid'] == '2') {
          $change['status'] = 2;
          return Manager:: where('id',$id) -> update($change) ? '1' : '0';
      }
      
      
      //删除
      if ($orderid['orderid'] == '3') {
         return Manager:: find($id) -> delete() ? '1' : '0';
      }

      //批量删除
      if ($orderid['orderid'] == '4') {
        $ids = explode(',',$id);
        //dd($ids);die;
        foreach ($ids as $value) {
            Manager::find($value) -> delete();
        }
        $ifhaveid = array_key_last($ids);

         return Manager:: find($ids[$ifhaveid]) ? '0' : '1';
      }
      
    }
}
