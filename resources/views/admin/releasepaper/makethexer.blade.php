<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/public/css/app.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <title>试题页面</title>
</head>

<body>
<div class="container-fluid">
<form action="{{route('mkthexer',$id)}}" method="POST">
@csrf
  <div class="row mt-3">
    <div class="col-6">
      <p class="font-weight-bold text-danger">得分: {{$othernum['tolscores']}}</p> <small>总分: {{$othernum['allscores']}}<br>共{{$othernum['quenum']}}题</small>
    </div>
    <div class="col-6 text-right">
      @if($othernum['ifsecond'])
      <button type="button" class="btn btn-secondary disabled  mt-2 mr-2" value="1">提交</button>
      @else
      <button type="submit" id="submitpaper" class="btn btn-primary  mt-2 mr-2" value="1">提交</button>
      @endif
      <a  type="button" id="quitpaper" href="javascript:0;" class="btn btn-danger mt-2 mr-3" onclick="quitpaper({{$othernum['ifsecond']}});"  value="2">退出</a>
    </div>
  </div>
  <div class="ml-3 align-middl">
  @foreach($data as $key => $val)
  <div class="row mt-3 ml-3 mr-3">
    <div class="mt-2 card w-100" >
      <div class="card-body">
        <div class="col-9 float-left">
          <p>{{$key+1}}. {{$val['exerpaper_name']}}</p>
          <div class="form-check ">
            <input class="form-check-input" type="radio" name="inlineRadioOptions{{$key}}" id="inlineRadio{{$key}}_A" value="A">
            <label class="form-check-label" id="opt{{$key+1}}_A" name="A" for="inlineRadio{{$key}}_A">{{$tmp[$key][0]}}</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="inlineRadioOptions{{$key}}" id="inlineRadio{{$key}}_B" value="B">
            <label class="form-check-label"  name="B" for="inlineRadio{{$key}}_B" >{{$tmp[$key][1]}}</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="inlineRadioOptions{{$key}}" id="inlineRadio{{$key}}_C" value="C">
            <label class="form-check-label"  name="C" for="inlineRadio{{$key}}_C" >{{$tmp[$key][2]}}</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="inlineRadioOptions{{$key}}" id="inlineRadio{{$key}}_D" value="D">
            <label class="form-check-label"  name="D" for="inlineRadio{{$key}}_D" >{{$tmp[$key][3]}}</label>
          </div>
        </div>
      </div>
      <div class="col-auto ">
        <div class="ml-2">
        @if($othernum['ifsecond'])
          @if($ifcorrect['inlineRadioOptions'.$key])
          <span class="text-success">您的答案：
          @if(array_key_exists('inlineRadioOptions'.$key,$allanwch)) {{$allanwch['inlineRadioOptions'.$key]}} 
          @else null
          @endif
          </span>
          <span class="text-success"><i class="bi bi-check2-circle"></i> 得分：{{$val['score']}}</span>

          @else
          <span class="text-danger">您的答案：
          @if(array_key_exists('inlineRadioOptions'.$key,$allanwch)) {{$allanwch['inlineRadioOptions'.$key]}} 
          @else null
          @endif
          </span>
          <span class="text-danger"><i class="bi bi-x"></i> 得分：0</span>
          @endif
        @endif
        </div>
      </div>
    </div>
  </div>
  @endforeach
</form>
</div>

<!-- <script type="text/javascript" src="/public/admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/public/admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/public/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script> -->
<script type="text/javascript" src="/public/js/app.js"></script>

<script type="text/javascript" >


/*setTimeout('myrefresh()',1000); //指定1秒刷新一次
function myrefresh()
{
  window.location.reload();
}
*/

function quitpaper($ifsecond){
  if ($ifsecond) {
    window.location.href = "{{route('releasepaper')}}";
  }else{
    window.history.back(-1);
  }
}


//启动富文本
/*$(function(){
  var ue = UE.getEditor('editor');
});*/
   
  //将页面课程id传给模态框
  $("#staticBackdrop").modal("hide");
  function transmit(){
    $("#staticBackdrop").modal("show");
    var id = document.getElementById("thecourque").value;
    //向模态框中传值
    $('#courid').val(id);
  }


</script>

</body>

</html>