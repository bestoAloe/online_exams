<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/public/css/app.css"/>

    <title>发布管理</title>
</head>

<body>
<div class="container-fluid">
  <div class="row mt-3">
    <div class="col-6 my-2">
    <form action="{{ route('releasepaper') }}" method="POST" id="autosubmit">
    @csrf
      <select class="custom-select" name="course_id" onchange="submitform();">
        @if($courid == '')
        <option value="0" selected>选择课程</option>
        @endif
        @foreach($courdata as $val)
        @if($val->reathecourse->id == $courid)
        <option value="{{$val->reathecourse->id}}" selected>{{$val->reathecourse->course_name}}</option>
        @else
        <option value="{{$val->reathecourse->id}}">{{$val->reathecourse->course_name}}</option>
        @endif
        @endforeach
      </select>
    </form>
    </div>
    @if($courid != '')
    <div class="col-4">
      <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#relepapers" value="">发布试卷</button>
    </div>
    @endif
  </div>
  @if($courid != '')
  <table class="table table-bordered table-hover mt-2">
    <thead class="thead-light">
      <tr class="text-center">
        <th scope="col">id</th>
        <th scope="col">试卷名称</th>
        <th scope="col">所属课程</th>
        <th scope="col">开始时间</th>
        <th scope="col">结束时间</th>
        <th scope="col">题目数量</th>
        <th scope="col">重做次数</th>
        <th scope="col">提交数/总数</th>
        <th scope="col">作答详情</th>
        <th scope="col">试题详情</th>
        <th scope="col">操作</th>
      </tr>
    </thead>
    <tbody>
    @foreach($reledata as $fabu)
      @if(isset($fabu->reatestpaper->course_id) && $fabu->reatestpaper->course_id == $courid)
      <tr class="text-center">
        <td scope="row">{{$num++}}</td>
        <td class="align-middle">{{$fabu->reatestpaper->testpaper_name}}</td>
        <td class="align-middle">{{$fabu->reatestpaper->reatocourse->course_name}}</td>
        <td class="align-middle">{{$fabu->perstarttime}}</td>
        <td class="align-middle">{{$fabu->perendtime}}</td>
        <td class="align-middle">{{$fabu->quenum}}</td>
        <td class="align-middle">{{$fabu->remakenum}}</td>
        <td class="align-middle">n/m</td>
        <td class="align-middle">
          <a class="btn btn-primary btn-sm mt-2" href="{{route('answeranalysis',$fabu->id)}}" role="button">查看作答</a>
        </td>
        <td class="align-middle">
          <a class="btn btn-primary btn-sm mt-2" href="{{route('mkthexer',$fabu->id)}}" role="button">进入试题</a>
        </td>
        <th class="align-middle"><a class="text-dark" href="javascript:;" onclick="transmit('{{$fabu->id}}','{{$fabu->testpaper_id}}','{{$fabu->quenum}}','{{$fabu->remakenum}}','{{$fabu->perstarttime}}','{{$fabu->perendtime}}');" data-toggle="modal" data-target="#editpapers"><i class="Hui-iconfont">&#xe6df;</i></a> / <a class="text-dark" href="javascript:;" onclick="delpaper('{{$fabu->id}}','4')"><i class="Hui-iconfont">&#xe6e2;</i></a></th>
      </tr>
      @endif
    @endforeach
    </tbody>
  </table>
  @endif
  <!-- 发布试卷模态框 -->
  <div class="modal fade" id="relepapers" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">请填写发布内容</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="relepaperform" action="" method="POST">
          <div class="modal-body">
            <input type="hidden" name="orderid" id="orderid" value="2">
            <div class="overflow-auto">
              <label>试卷名称</label><br>
              <select class="custom-select" name="testpaper_id">
                <option selected class="text-secondary">没有试卷</option>
              @foreach($testdata as $tmp)
                @if($tmp->course_id == $courid)
                <option class="text-dark" value="{{$tmp->id}}">{{$tmp->testpaper_name}}</option>
                @endif
              @endforeach
              </select>
              <div class=" mt-3">
                <label>题目数量</label><br>
                <input type="text" id="quenum" name="quenum" value="" width= 80%>
              </div>
              <div class=" mt-3">
                <label>重做次数</label><br>
                <input type="text" id="remakenum" name="remakenum" value="" width= 80%>
              </div>
              <div class=" mt-3">
                <label>开始时间</label><br>
                <input type="datetime-local" id="perstarttime" name="perstarttime" value="" width= 80%>
              </div>
              <div class=" mt-3">
                <label>结束时间</label><br>
                <input type="datetime-local" id="perendtime" name="perendtime" value="" width= 80%> 
              </div>
            </div>   
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            <button type="button" id="sendque2"  class="btn btn-primary">发布</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- 编辑试卷模态框 -->
  <div class="modal fade" id="editpapers" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel2">请填写发布内容</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editpaperform" action="" method="POST">
          <div class="modal-body">
            <input type="hidden" name="orderid" id="orderid2" value="3">
            <input type="hidden" name="releid" id="releid" value="">
            <div class="overflow-auto">
              <label>试卷名称</label><br>
              <select class="custom-select" id="testpaper_id2" name="testpaper_id2">
                <option class="text-dark" value="0">暂无试卷</option>
              @foreach($testdata as $shijuan)
                @if($shijuan->course_id == $courid)
                <option class="text-dark" value="{{$shijuan->id}}">{{$shijuan->testpaper_name}}</option>
                @endif
              @endforeach
              </select>
              <div class=" mt-3">
                <label>题目数量</label><br>
                <input type="text" id="quenum2" name="quenum2" value="" width= 80%>
              </div>
              <div class=" mt-3">
                <label>重做次数</label><br>
                <input type="text" id="remakenum2" name="remakenum2" value="" width= 80%>
              </div>
              <div class=" mt-3">
                <label>开始时间</label><br>
                <input type="datetime-local" id="perstarttime2" name="perstarttime2" value="" width= 80%>
              </div>
              <div class=" mt-3">
                <label>结束时间</label><br>
                <input type="datetime-local" id="perendtime2" name="perendtime2" value="" width= 80%> 
              </div>
            </div>   
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" id="keepaer"  class="btn btn-primary">保存</button>
          </div>
        </form>
      </div>
    </div>
  </div>
 
</div>

<script type="text/javascript" src="/public/js/app.js"></script>

<script type="text/javascript" >


/*setTimeout('myrefresh()',1000); //指定1秒刷新一次
function myrefresh()
{
  window.location.reload();
}
*/


//课程自动提交表单
function submitform(){
  var form = document.getElementById('autosubmit');

  form.submit();
}

//发布模态框反馈信息
$("#sendque2").click(function(){
  $.ajax({
      url:"{{route('releasedeal')}}",
      type:"POST",
      headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      },
      data:$('#relepaperform').serialize(),
      success:function(result){
          if(result == 1){
             alert('发出成功'); 
             $('#relepapers').modal('hide');
             window.location.reload();
          }
      },
      error:function(XmlHttpRequest, textStatus, errorThrown){
          alert('发出失败');
      }
  })
})

//编辑模态框反馈信息
$("#keepaer").click(function(){
  $.ajax({
      url:"{{route('releasedeal')}}",
      type:"POST",
      headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      },
      data:$('#editpaperform').serialize(),
      success:function(result){
          if(result == 1){
             alert('保存成功'); 
             $('#editpapers').modal('hide');
             window.location.reload();
          }
      },
      error:function(XmlHttpRequest, textStatus, errorThrown){
          alert('保存失败');
      }
  })
})

//编辑
function transmit(releid,testperid,num,remakenum,starttime,endtime){
  $("#editpapers").modal("show");
  //var id = document.getElementById("bel_queid").value;
  //向模态框中传值
  $('#quenum2').val(num);
  $('#remakenum2').val(remakenum);
  $('#releid').val(releid);

  var timeStamp = new Date(starttime).getTime();
  var timeStamp2 = new Date(endtime).getTime();

  //时间戳转化成日期格式
  Date.prototype.Format = function(fmt){
    var oo = {
      "M+" : this.getMonth()+1,   //月份
      "d+" : this.getDate(),   //日
      "h+" : this.getHours(),   //小时
      "m+" : this.getMinutes(),   //分
      "s+" : this.getSeconds(),   //秒
      "q+" : Math.floor((this.getMonth()+3)/3),   //季度
      "S+" : this.getMilliseconds(),   //毫秒
    };
    if(/(y+)/.test(fmt))
      fmt = fmt.replace(RegExp.$1,(this.getFullYear()+"").substr(4 - RegExp.$1.length));
    for (var k in oo) {
      if(new RegExp("("+k+")").test(fmt))
        fmt = fmt.replace(RegExp.$1,(RegExp.$1.length == 1) ? (oo[k]) : (("00"+oo[k]).substr((""+oo[k]).length)));
    }
    return fmt;
  };

  $('#perstarttime2').val(new Date(starttime).Format("yyyy-MM-ddThh:mm:ss"));
  $('#perendtime2').val(new Date(endtime).Format("yyyy-MM-ddThh:mm:ss"));

  var chils = document.getElementById("testpaper_id2").childNodes;
  chils.forEach(function(item){
    //console.log(item.value+','+testperid);
    //item.value是testpaper表中的id，relepaper的testpaper_id和testpaper表中的id比较
    if(item.value == testperid){
      item.selected = true;
    }
  });
}

//删除
function delpaper($releid,$orderid){
  $.ajax({
      url:"{{route('releasedeal')}}",
      type:"POST",
      headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      },
      data:{
        orderid:$orderid,
        id:$releid,
      },
      success:function(result){
          if(result == 1){
             alert('删除成功'); 
             window.location.reload();
          }
      },
      error:function(XmlHttpRequest, textStatus, errorThrown){
          alert('删除失败');
      }
  })
}

</script>

</body>

</html>