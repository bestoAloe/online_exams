<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/public/css/app.css"/>

    <title>课程练习</title>
    <style>
      body {
        background-color: #a6bfc6;
      }
      .toubu{
        width: 70%;
        height: auto;
        margin: auto;
      }
      .xiabu{
        width: 70%;
        height: auto;
        margin: auto;
      }

      .bg-color0{
        background-color: #83b3c4 !important;
      }

      .bg-color1{
        background-color: #eee !important;
      }


      .btn-color1 {
        color: #555;
        background-color: #FBC9D3;
        border-color: 1px  solid rgba(240, 240, 240, 0.5);
      }
      
    </style>
</head>

<body>
<div class="container-fluid">
  <div class="toubu">
    <div class="row mt-4">
      <div class="col-sm-3 mx-auto d-block">
        <form action="{{ route('exerpaperlist') }}" method="post" id="autosubmit">
        @csrf
          <select class="form-control" name="course_id" onchange="submitform();">
            @if($courid == '') 
            <option value="0" selected>选择课程</option>
            @endif
            @foreach($courdata as $val)
            @if(isset($val->reathecourse->id) && $val->reathecourse->id == $courid)
            <option value="{{$val->reathecourse->id}}" selected>{{$val->reathecourse->course_name}}</option>
             <?php continue; ?>
            @else
            <option value="{{$val->reathecourse->id}}">{{$val->reathecourse->course_name}}</option>
            @endif
            @endforeach
          </select>
        </form>
      </div>
    </div>
    @if($courid != '')
    <div class="row mt-2">
      <table class="table table-bordered table-hover mt-2">
        <thead class="thead-light">
          <tr class="text-center">
            <th scope="col">id</th>
            <th scope="col">试卷名称</th>
            <th scope="col">所属课程</th>
            <th scope="col">开始时间</th>
            <th scope="col">结束时间</th>
            <th scope="col">试题详情</th>
          </tr>
        </thead>
        <tbody>
        @foreach($reledata as $key => $val)
        @if(isset($val->reatestpaper->course_id) && $val->reatestpaper->course_id == $courid)
          <tr class="text-center bg-color1">
            <th class="align-middle">{{$num++}}</th>
            <td class="align-middle">{{$val->reatestpaper->testpaper_name}}</td>
            <td class="align-middle">{{$val->reatestpaper->reatocourse->course_name}}</td>
            <td class="align-middle">{{$val->perstarttime}}</td>
            <td class="align-middle">{{$val->perendtime}}</td>
            @if($val->remakenum > 0 && $val->perstarttime <= date('Y-m-d H:i:s') &&date('Y-m-d H:i:s') <= $val->perendtime)
            <td class="align-middle">
              <a class="btn btn-color1 mt-2" href="{{route('exepaperstu',$val->id)}}" role="button">进入试题({{$val->remakenum}})</a>
            </td>
            @else
            <td class="align-middle">
              <a class="btn btn-secondary disabled mt-2" role="button" aria-disabled="true">进入试题</a>
            </td>
            @endif
          </tr>
        @endif
        @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>
</div>

<script type="text/javascript" src="/public/js/app.js"></script>
<script type="text/javascript" >


setTimeout('myrefresh()',15000); //指定15秒刷新一次
function myrefresh()
{
  window.location.reload();
}


//课程自动提交表单
function submitform(){
  var form = document.getElementById('autosubmit');

  form.submit();
}

</script>

</body>

</html>