<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exeranalysis extends Model
{
   //定义关联的数据表
    protected $table = 'exeranalysis';
   
   //关联学生表
   public function reatostu(){
   	return $this -> hasOne('App\Models\Students','id','studentid');
   }
}
