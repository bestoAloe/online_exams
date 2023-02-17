<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Exerpaper extends Model
{
	//定义关联的数据表
   protected $table = 'exerpaper';

   //关联模型
   /*关联试卷，一对一*/
   public function reatestpaper(){
   	return $this -> hasOne('App\Models\Admin\Testpaper','id','testpaper_id');
   }

   public function radatasea($paperid,$num){
   	$data = self::select('id','exerpaper_name','testpaper_id','score','options','answer')
   	         ->where('testpaper_id',$paperid)
   	         ->orderBy(DB::raw('RAND()'))
   	         ->take($num)
   	         ->get();
   	return $data;
   }
}
