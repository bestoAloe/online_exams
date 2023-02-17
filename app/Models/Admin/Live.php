<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    //关联数据表
    protected $table = 'live';

    //需要关联专业和直播流
    public function reatoprof(){
    	//关联专业  1 对1
    	return $this -> hasOne('App\Models\Admin\Profession', 'id', 'profession_id');
    }

    public function reatostream(){
    	//关联直播流  1 对1
    	return $this -> hasOne('App\Models\Admin\Stream', 'id', 'stream_id');
    }
    
    //处理video_addr
    public function deal_addr($live_name){
        $data = self::where('live_name',$live_name)->get('video_addr')->toArray();
        $urlnum = mb_strrpos($data[0]['video_addr'],'观');
        $url = mb_substr($data[0]['video_addr'],$urlnum+5);
        //dd($url);die;
        return $url;
    }

}
