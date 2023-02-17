<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Stream;

use Qiniu\Pili\Client;
use function Qiniu\Pili\HDLPlayURL;
use Qiniu\Pili\Mac;

class StreamController extends Controller
{
    public function showlist(){
    	//获取数据
      $data = Stream::orderBy('sort','desc') -> get();
      //展示视图
      return view('admin.stream.showlist',compact('data'));
    }

    //直播流添加
    public function addstr(Request $request){
    	if($request->method() == 'POST'){
            $ak = "DdcGe9FSX2Nh-6haoE0EkmRDZRbi3DN5-ofWko-T";
            $sk = "aEGc490UHoehxBw6B2SaExyCpo1VDT01980HTG4o";
            $client = new Client(new Mac($ak,$sk));
            $hub = $client->hub('zhibobishe');
            //$resp = $hub->listStreams('',20,'');
            
            $data = $request ->except('_token');  //除去token
            $stream = $hub->create($data['stream_name']);
    		$resp = $hub->listStreams('',10,'');
            //dd($resp);die;
    		//转化时间  时间戳才可入表
    		$data['permited_at'] = strtotime($data['permited_at']);

            //如果直播流被限时禁止，指定限时时间;
            if ($data['status'] == '3') {
                $stream->disable($data['permited_at']);
            }
    		//var_dump($data); die;
    		//
    		//插入表
    		return Stream::insert($data) ? '1' : '0';
    		
    	}else{
    		//展示视图
    		return view('admin.stream.addstr');
    	}
    }
}
