<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Coursearrage;
use App\Models\Admin\Protype;
use App\Models\Admin\Manager;
use DB;

class CoursearrController extends Controller
{
	//课程安排展示
	public function showlist(){
		$data = Coursearrage::all();
		return view('admin.coursearr.showlist',compact('data'));
	}

	public function coursearradd(Request $request){
		if ($request->method() == 'POST') {
			$data = $request->except(['_token','protype_id','profession_id']);
			$data['created_at'] = date('Y-m-d  H:i:s');
			//dd($data);die;
			return Coursearrage::insert($data) ? '1' : '0';
		}else{
			$data = Protype::get(['id','protype_name']);
			$tmp = Manager::get(['id','username']);
			return view('admin.coursearr.coursearradd',compact('data','tmp'));
		}
	}

	public function getprotyid(Request $request){
		$protype_id = $request -> get('protype_id');

		$prof = DB::table('profession') -> where('protype_id',$protype_id)->get();
		//var_dump($prof);die;
		return response() -> json($prof);
	}

	//课程id获取
   public function getprofeid(Request $request){
		$profess_id = $request -> get('profession_id');

		$prof = DB::table('course') -> where('profession_id',$profess_id)->get();
		//var_dump($prof);die;
		return response() -> json($prof);
    }
}
