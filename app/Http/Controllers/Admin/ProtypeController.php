<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//引入模型
use App\Models\Admin\Protype;

class ProtypeController extends Controller
{
    public function showlist(){
    	//获取数据
    	$data = Protype::orderBy('sort','desc') -> get();
    	//展示视图
    	return view('admin.protype.showlist',compact('data'));
    }

    public function addprotype(Request $request){
    	if ($request -> method() == 'POST') {
    		$data = $request -> except('_token');
    		$data['created_at'] = date('Y-m-d H:i:s');
    		//dd($data);die;
    		return Protype::insert($data) ? '1' : '0';
    	}
    	return view('admin.protype.addprotype');
    }
}
