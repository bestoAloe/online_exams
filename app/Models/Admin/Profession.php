<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    //定义当前模型需要关联的数据表
    protected $table = 'profession';

    //关联模型
    /*需要借助关联模型/联表查询来实现真实名称的展示操纵，以关联模型为例：profession 关联Protype*/
    //定义与protype模型的关系: 1对1
    public function rea_protype(){
    	return $this -> hasOne('App\Models\Admin\Protype','id','protype_id');
    }
}
