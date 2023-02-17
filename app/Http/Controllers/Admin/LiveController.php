<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Protype;
use App\Models\Admin\Live;
use App\Models\Admin\Course;
use App\Models\Admin\Stream;
use DB;
use Storage;
//七牛云服务skd
use Qiniu\Pili\Client;
use Qiniu\Pili\Mac;
use function Qiniu\Pili\RTMPPublishURL;
use function Qiniu\Pili\HDLPlayURL;

class LiveController extends Controller
{
	public function showlist(Request $request){

		$geturl = '';
		$data = Live::get();

		//回放下载
		if ($request->method() == 'POST') {
			$live_name = $request->get("live_name");
			//dd($live_name);die;
			$ak = "DdcGe9FSX2Nh-6haoE0EkmRDZRbi3DN5-ofWko-T";
	      $sk = "aEGc490UHoehxBw6B2SaExyCpo1VDT01980HTG4o";
	      $client = new Client(new Mac($ak,$sk));
	      $hub = $client->hub('zhibobishe');
	      $stream = $hub->stream($live_name);
	      //推流历史
	      $records = $stream->historyActivity(0, 0);
	      $newrecords = $records['items']['0'];

	      //判断是否已经保存
	      if ($request->session()->has($live_name)){
	      	$geturl = $request->session()->get($live_name);
	      }else{
	      	//回放保存至七牛云存储
	         $resp = $stream->saveas(array("format" => "mp4","start" =>$newrecords['start'],"end"=>$newrecords['end']));
	         $downurl = 'http://pili-vod.lelarve.cn/'.$resp['fname'];
	         $request->session()->put($live_name,$downurl);
	         $geturl = '';
	      }
	      
	      //dd($geturl);die;
	      return response() -> json(['url'=>$geturl]);
		}else {
			return view('admin.live.showlist',compact('data','geturl'));
		}

		
	}

	//添加直播课程
	public function addlive(Request $request){
		if ($request -> method() == 'POST') {
			$data = $request -> except(['_token','protype_id']);
			$tmp['profession_id'] = $data['profession_id'];
			$data['course_name'] = Course::where('id',$data['course_id'])->get('course_name')->toArray();
			$tmp['live_name'] = $data['course_name'][0]['course_name'];
			$tmp['stream_id'] = $data['stream_id'];
			$tmp['description'] = $data['description'];
			$tmp['begin_at'] = strtotime($data['begin_at']);
			$tmp['end_at'] = strtotime($data['end_at']);
			$tmp['status'] = $data['status'];
			//dd($tmp);die;
			return Live::insert($tmp) ? '1' : '0';
		}else{
			$data = Protype::get(['id','protype_name']);
			$tmp = Stream::get();
		   return view('admin.live.addlive',compact('data','tmp'));
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

	//发布直播
	public function fabulive(Request $request){
		if ($request->method() == 'POST') {
			$ak = "DdcGe9FSX2Nh-6haoE0EkmRDZRbi3DN5-ofWko-T";
         $sk = "aEGc490UHoehxBw6B2SaExyCpo1VDT01980HTG4o";
         $client = new Client(new Mac($ak,$sk));
         $hub = $client->hub('zhibobishe');
			$thelive = $request -> except('_token');
			$stream = $hub->stream($thelive['stream_name']);
			//获取推流地址
			$rtmpurl = \Qiniu\Pili\RTMPPublishURL("pili-publish.lelarve.cn", "zhibobishe", $thelive['stream_name'], 3600, $ak, $sk);
			//获取拉流地址
			$liveurl = \Qiniu\Pili\HDLPlayURL("pili-live-hdl.lelarve.cn", "zhibobishe", $thelive['stream_name']);
			//dd($stream->info());die;
			
			$data['id'] = $thelive['id'];
			//处理字符
			$sdafter = substr($rtmpurl, strripos($rtmpurl, '/')+1);
			$sdbef = substr($rtmpurl,0,strripos($rtmpurl, '/')+1);
			$data['video_addr'] = '服务器：'.$sdbef.'串流密钥：'.$sdafter.'观看地址：'.$liveurl;
			//dd($data);die;
		
			//插入表
			return Live::where('id',$thelive['id'])->update($data) ? '1' : '0';
		}
	}

}
