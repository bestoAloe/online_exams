<?php

namespace App\Exports;

use App\Models\Admin\Exerpaper;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class ExerpaperModelExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function array():array{
   	$data = [
   	   //设置表头
   	   ['序号','题干','所属试卷','分值','选项','答案','创建时间'],
   	];

   	//获取数据
   	$exerData = Exerpaper::get();
   	//循环取出相应数据
   	foreach ($exerData as $key => $value) {
   		$data[] = [
   		  $value -> id,
   		  $value -> exerpaper_name,
   		  $value -> testpaper_id,
   		  $value -> score,
   		  $value -> options,
   		  $value -> answer,
   		  $value -> created_at,
   		];
   	}

   	return $data;
   }

}
