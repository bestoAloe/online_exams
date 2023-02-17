<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/public/css/app.css"/>

    <title>已选课程</title>
     <style>
      body {
        background-color: #a6bfc6;
      }
      .toubu{
        width: 70%;
        height: auto;
        margin: auto;
        background-color: #eee;
      }
      .xiabu{
        width: 70%;
        height: auto;
        margin: auto;
      }


      .bg-color1{
        background-color: #debcc3 !important;
      }


      .btn-color1 {
        color: #555;
        background-color: #e7b6c0;
        border-color: 1px  solid rgba(240, 240, 240, 0.5);
      }
      

    </style>
</head>

<body>
<div class="container-fluid ">
  <div class="toubu mb-2 rounded">
    <div class="row mt-4">
      <div class="col mt-3 ml-4"><h4>已有课程列表：</h4></div>
    </div>
    <div class="row row-cols-3 mt-2">
    @foreach($data as $val)
      <div class="col">
        <div class="row">
          <div class="col-sm-8 offset-sm-1 mt-3">
            <div class=""><img src="{{$val->reathecourse->cover_img}}"></div>
            <h5 class="mt-2">{{$val->reathecourse->course_name}}</h5>
            <div class="text-dark">
             <div> {{$val->classtime}}</div>
             @if(isset($val->reacourther->username))
             <div> {{$val->reacourther->username}}</div>
             @endif
             <button type="button" class="btn btn-color1 btn-sm text-dark mt-1 mb-3" onclick="dropcour({{$val->course_id}})">退选</button>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    </div>
  </div>

</div>

<script type="text/javascript" src="/public/js/app.js"></script>

<script type="text/javascript" >
//退选课程
function dropcour($id){
  $.ajax({
      url:"{{route('courhave')}}",
      type:"POST",
      headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      },
      data:{
        course_id:$id,
      },
      success:function(result){
          if(result == 1){
             alert('退选成功'); 
             window.location.reload();
          }
      },
      error:function(XmlHttpRequest, textStatus, errorThrown){
          alert('退选失败');
      }
  })
}

</script>

</body>

</html>