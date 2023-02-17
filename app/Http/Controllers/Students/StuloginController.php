<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StuloginController extends Controller
{
   //验证数据
	public function checked(Request $request){
		//开始自动验证
	  $this->validate($request,[
	      //验证规则语法   需要验证的字段名 => ‘验证规则1 | 验证规则2 | 验证规则3：20 | ... ’
	      //用户名必填 长度介于2--20
	      'stu_name' => 'required|min:1|max:20',
	      //密码必填，长度至少6
	      'password' => 'required|min:6',
	      //验证码必填，长度5，必须的合法的验证码
	      'captcha' => 'required|size:4|captcha'
	  ]);
	  

		//继续开始进行身份核实
		$data = $request -> only('stu_name','password'); //不用all()
		$data['status'] = '2';
		$result = Auth::guard('students') -> attempt($data,$request -> get('online'));
	   //dd($result);die;
		//判断是否成功
		if($result){
		   //跳转到首页
		   return redirect()->route('shoupage');
		}
		else{
		   //跳到登录页面
		   return redirect('') -> withErrors(['loginError' => '用户名或密码错误。']);
		}
	}

	//用户退出
	public function logout(Request $request){
	  //退出
	  Auth::guard('students') -> logout();
	  //Auth::logout();

	  $request->session()->flush();
	  //$request->session()->regenerateToken();
	  $request->session()->regenerate();
	  
	  //跳转到登录页面
	  return redirect()->route('stulogin');
	}
}
