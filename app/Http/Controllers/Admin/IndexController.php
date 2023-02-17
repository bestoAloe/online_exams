<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Manager;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\Role;

class IndexController extends Controller
{
    //首页
    public function index(){
    	return view('admin.index.index');
    }

    //密码修改
    public function passwordinfo(Request $request){
    	if ($request -> method() == 'POST') {
    		$info = $request->all();
    		//dd($info);die;
    		$oldpass = Auth::guard('admin')->user()->password;
    		$newpas['password'] = bcrypt($info['newpassword']);
    		//dd($oldpass);die;
    		$id = Auth::guard('admin')->user()->id;
    		if (Hash::check($info['oldpassword'],$oldpass)) {
    			return Manager::where('id',$id)->update($newpas) ? '1' : '0';
    		}
    	}else{
    		return view('admin.index.passwordinfo');
    	}
    }

    //个人信息
    public function myselfinfo(Request $request){
    	$id = Auth::guard('admin')->user()->id;

    	if ($request -> method() == 'POST') {
    		$tmp = $request -> except('_token');
    		//dd($tmp);die;
    		return Manager::where('id',$id) -> update($tmp) ? '1' : '0';
    	}else{
    		$data = Manager::where('id',$id) -> get() -> toArray();
    		//dd($data);die;
    		$roleinfo = Role::where('id',$data[0]['role_id'])->get('role_name')->toArray();
    		//dd($roleinfo);die;
    		return view('admin.index.myselfinfo',compact('data','roleinfo'));
    	}
    	
    }

    //首页-框架页面
    public function welcome(){
    	return view('admin.index.welcome');
    }
}
