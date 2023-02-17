<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/public/css/app.css"/>
    <title>答疑列表</title>

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
        background-color: #debcc3 !important;
      }

      .bg-color2{
        background-color: #B5D7EE !important;
        border: 1px solid #B5D7EE;
      }

      .btn-color1 {
        color: #555;
        background-color: #f0bdc7;
        border-color: 1px  solid rgba(240, 240, 240, 0.5);
      }
      
    </style>

</head>

<body>
<div class="container-fluid">
  <div class="toubu">
    <div class="row mt-3 mx-auto">
      <div class="col-sm-3 offset-sm-4">
        <form action="{{ route('coursedayi') }}" method="post" id="autosubmit">
        @csrf
          <select class="form-control mt-1" name="course_id" onchange="submitform();">
            @if($selvel == 0) 
            <option value="0" selected>选择课程</option>
            @endif
            @foreach($data as $val)
            @if($val->reathecourse->id == $selvel)
            <option value="{{$val->reathecourse->id}}" selected>{{$val->reathecourse->course_name}}</option>
             <?php continue; ?>
            @endif
            <option value="{{$val->reathecourse->id}}">{{$val->reathecourse->course_name}}</option>
            @endforeach
          </select>
        </form>
      </div>
      <div class="col-sm-2">
        @if($selvel != 0)
        <button type="button" id="thecourque" class="btn btn-color1 mt-2" data-toggle="modal" data-target="#staticBackdrop" value="{{$selvel}}" onclick="transmit()">提问题</button>
        @endif
      </div>
    </div>
    
    <div class="row my-3" id="ulfoldall" name="ulfoldall">
    @foreach($getque as $val2)
      <div class="col-sm-6 mt-2 float-right  img-thumbnail" >
        <div class="" id="hedding{{$val2->id}}">
            <button class="btn btn-link w-75 rounded-bottom rounded-top text-left collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapse{{$val2->id}}" aria-expanded="false" aria-controls="collapse{{$val2->id}}">
              <small class="col font-italic">
                @if($val2->role_id == '3')
                {{$val2->rea_student->stu_name}} <span class="badge badge-primary">学生</span> 
                @else  
                {{$val2->rea_manager->username}} <span class="badge badge-success" >老师</span> 
                @endif <span class="text-secondary"> {{$val2 -> created_at}} 提问：</span>
              </small><br>
              <!-- <input type="hidden" id="bel_queid" value="{{$val2->id}}"> -->
              <span class="text-success overflow-auto ml-3">{{$val2 -> question}}</span>
            </button>
            <button type="button" onclick="transmit2('{{$val2->id}}')" class="btn btn-color1 btn-sm float-right mt-2 mr-5" data-toggle="modal" data-target="#staticBackdrop2">回复</button>
        </div>
        <div id="collapse{{$val2->id}}" class="collapse" aria-labelledby="heading{{$val2->id}}" data-parent="#ulfoldall">
          <div class="card-body">
            <ul class="list-group">
              @foreach($getanw as $tmp)
                @if($tmp->bel_que == $val2->id)
                <li class="list-group-item">
                   <small class="font-italic">
                      @if($tmp->role_id == '3') {{$tmp->rea_student->stu_name}} <span class="badge badge-primary">学生</span> 
                      @else {{$tmp->rea_manager->username}} <span class="badge badge-success" >老师</span> 
                      @endif <span class="text-secondary"> {{$tmp -> created_at}} 回答：</span>
                   </small>  
                   <span class="text-justify overflow-auto font-weight-light"> {{$tmp->anw_show}}</span></li>
                @endif
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    @endforeach
    </div>

     <!-- 提问题模态框 -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">提问题</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="POST">
            <div class="modal-body">
              <div class="overflow-auto">
                <div>请输入问题</div>
                  <input type="hidden" name="thiscourid" id="courid" value="">
                <!-- <script id="editor" class="" type="text/plain" style="width:100%;height:60%;"></script> -->
                
                  <input type="text" id="thiscourque" name="queinfo" value="" width= 80%>
                
              </div>   
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
              <button type="button" id="sendque"  class="btn btn-primary">发出</button>
            </div>
          </form>
        </div>
      </div>
    </div>

       <!-- 回复模态框 -->
    <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel2">回复</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="POST">
            <div class="modal-body">
              <div class="overflow-auto">
                <div>请输入内容</div>
                  <input type="hidden" name="thisqueid" id="queid" value="">
                <!-- <script id="editor" class="" type="text/plain" style="width:100%;height:60%;"></script> -->
                
                  <input type="text" id="thisanw" name="anwinfo" value="" width= 80%>
                
              </div>   
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
              <button type="button" id="sendque2"  class="btn btn-primary">发出</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> 
 
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

//提问模态框反馈信息
$("#sendque").click(function(){
  var courid = $("#courid").val();
  var queinfo = $("#thiscourque").val();
  $.ajax({
      url:"{{route('addcourseque')}}",
      type:"POST",
      data:{
        'bel_course':courid,
        'question':queinfo,
        '_token':'{{csrf_token()}}',
      },
      success:function(result){
          if(result == 1){
             alert('发出成功'); 
             $('#staticBackdrop').modal('hide');
             window.location.reload();
          }
      },
      error:function(XmlHttpRequest, textStatus, errorThrown){
          alert('发出失败');
      }
  })
})

//回复模态框反馈信息
$("#sendque2").click(function(){
  var queid = $("#queid").val();
  var anwinfo = $("#thisanw").val();
  $.ajax({
      url:"{{route('addcourseanw')}}",
      type:"POST",
      data:{
        'bel_que':queid,
        'anw_show':anwinfo,
        '_token':'{{csrf_token()}}',
      },
      success:function(result){
          if(result == 1){
             alert('发出成功'); 
             $('#staticBackdrop2').modal('hide');
             window.location.reload();
          }
      },
      error:function(XmlHttpRequest, textStatus, errorThrown){
          alert('发出失败');
      }
  })
})

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

  //将问题id传给模态框
  //$("#staticBackdrop2").modal("hide");
  function transmit2(id){
    $("#staticBackdrop2").modal("show");
    //var id = document.getElementById("bel_queid").value;
    //向模态框中传值
    $('#queid').val(id);
  }

//课程自动提交表单
function submitform(){
  var form = document.getElementById('autosubmit');

  form.submit();
}

</script>

</body>

</html>