<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Students;
use App\Models\Admin\Profession;
use Illuminate\Support\Facades\Hash;

class ShouyeController extends Controller
{
   public function shouye(Request $request){
   	//个人信息
		if ($request->method() == 'POST') {
			$tmp = $request->except('thisqueid');
			//专业id对应
			$bel_pro = Profession::where('profession_name',$tmp['bel_profession'])->get('id')->toArray();
			$tmp['bel_profession'] = $bel_pro[0]['id'];
   		//var_dump($tmp);die;
   		$id = Auth::guard('students')->user()->id;
   		//var_dump(Students::find($id));die;
   		return Students::where('id',$id)->update($tmp) ? '1' : '0';
		}else{
			//获取数据
	   	$id = Auth::guard('students')->user()->id;
	   	$data = Students::where('id',$id)->get(['stu_name','gender','mobile','email','bel_profession'])->toArray();
	   	$pro =Students::find($id);
	   	$x = $pro->rea_profession()->get('profession_name')->toArray();
	   	$data[0]['bel_profession'] = $x[0]['profession_name'];
	   	//dd($data);die;
	   	//查看视图
	   	return view('shouye',compact('data'));
		}
   }

   public function checkpas(Request $request){
   	if ($request->method() == 'POST') {
   		$passall = $request->all();
   		//对比原密码
	   	$old_pass = Auth::guard('students')->user()->password;  //原密码
	   	$new_pass['password'] = bcrypt($passall['passwordNew']); //用户密码加密函数
	   	$ifpassame = '';
	   	$id = Auth::guard('students')->user()->id;

	   	// $ifpassame = Hash::check($passall['passwordOld'],$old_pass);
	   	// var_dump($ifpassame);die;

	   	if (Hash::check($passall['passwordOld'],$old_pass)) {
	   		if (Students::where('id',$id)->update($new_pass)) {
	   			$ifpassame = '1';
	   			//var_dump($ifpassame);die;
	   		}else{
	   			$ifpassame = '0';
	   			//var_dump($ifpassame);die;
	   		}
	   	}else{
	   		$ifpassame = '2';
	   		//var_dump($ifpassame);die;
	   	}
	   	
	   	return $ifpassame;
   	}
   }

   public function zhognbufujia($id){
   	if ($id == '1') {
   		//5分钟英语短文
   		return view('shouyeinfo.engtext');
   	}elseif ($id == '2') {
   		//5分钟大学故事
   	 	return view('shouyeinfo.collegestory');
   	}else{
   		//阅读推荐
   		return view('shouyeinfo.readtoyou');
   	}
   	
   }
}
