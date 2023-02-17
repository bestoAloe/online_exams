<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    //登录页面的展示
    public function login(){
    	return view('\admin\public\login');
    }

    //验证数据
    public function check(Request $request){
    	//开始自动验证

    	/*$validatedDta = $request->validate([
    		//验证规则语法   需要验证的字段名 => ‘验证规则1 | 验证规则2 | 验证规则3：20 | ... ’
    		//用户名必填 长度介于2--20
    		'username' => 'required|min:2|max:20',
    		//密码必填，长度至少6
    		'password' => 'required|min:6',
    		//验证码必填，长度5，必须的合法的验证码
    		'captcha' => 'required|size:5|captcha'
    	]);*/

        $this->validate($request,[
            //验证规则语法   需要验证的字段名 => ‘验证规则1 | 验证规则2 | 验证规则3：20 | ... ’
            //用户名必填 长度介于2--20
            'username' => 'required|min:1|max:20',
            //密码必填，长度至少6
            'password' => 'required|min:6',
            //验证码必填，长度5，必须的合法的验证码
            'captcha' => 'required|size:4|captcha'
        ]);
        

    	//继续开始进行身份核实
    	$data = $request -> only('username','password'); //不用all()
    	$data['status'] = '2';
    	$result = Auth::guard('admin') -> attempt($data,$request -> get('online'));
        //dd($result);
        //判断是否成功
        if($result){
            //跳转到后台页面
            return redirect()->route('HouShou');
        }
        else{
            //跳到登录页面
            return redirect('') -> withErrors(['loginError' => '用户名或密码错误。'
            ]);
        }
    }

    //用户退出
    public function logout(Request $request){
        //退出
        Auth::guard('admin') -> logout();
        //Auth::logout();

        $request->session()->flush();
        //$request->session()->regenerateToken();
        $request->session()->regenerate();
        
        //跳转到登录页面
        return redirect()->route('adminLogin');
    }
    

}
