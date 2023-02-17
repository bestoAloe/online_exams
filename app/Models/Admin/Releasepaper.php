<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class releasepaper extends Model
{
   //定义关联的数据表
    protected $table = 'releasepaper';

    //关联模型
   /*关联试卷表，一对一*/
   public function reatestpaper(){
   	return $this -> hasOne('App\Models\Admin\Testpaper','id','testpaper_id');
   }

}
