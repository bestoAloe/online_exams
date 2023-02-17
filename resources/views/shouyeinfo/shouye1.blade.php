<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/public/css/app.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">

    <title>教育在线</title>
     <style>
      body {
        width: 100%;
        height: 100%;
        background-color: #83b3c4;
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
        background-color: #FBC9D3;
        border-color: 1px  solid rgba(240, 240, 240, 0.5);
      }
      

    </style>
</head>

<body>
<div class="container-fluid ">
  <div class="row mt-5 align-items-center">
    <div class="col-sm-6">
      <div class="row">
        <div class="col-sm-3  offset-sm-1">
          <div class="text-white offset-sm-6"><span>LOGO</span></div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="row">
        <div class="col-sm-6 offset-sm-5">
          <div class="text-white font-weight-bold">
            <ul class="list-group list-group-horizontal-sm">
              <li class="list-group-item border-0 bg-color0">
                <div><i class="bi bi-sliders2"></i> 课程管理</div>
              </li>
              <li class="list-group-item border-0 bg-color0">
                <div><i class="bi bi-person"></i> 用户信息</div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row my-4 justify-content-center">
    <div class="col-sm-3 order-1 my-1">
      <button type="button" class=" btn btn-color1 btn-lg btn-block offset-sm-5" style="width:50%;  height: 8em;">课程直播</button>
    </div>
    <div class="col-sm-3 order-2 my-1">
      <button type="button" class="btn btn-color1 btn-lg btn-block offset-sm-4" style="width:50%;  height: 8em;">视频播放</button>
    </div>
    <div class="col-sm-3 order-3 my-1">
      <button type="button" class="btn btn-color1 btn-lg btn-block offset-sm-2" style="width:50%;  height: 8em;">考试练习</button>
    </div>
    <div class="col-sm-3 order-4 my-1">
      <button type="button" class="btn btn-color1 btn-lg btn-block mr-5" style="width:50%;  height: 8em;">答疑互动</button>
    </div>
  </div>
  <div class="row mt-5 w-100">
    <div class="offset-sm-4"><canvas class="offset-sm-8" id="myCanvas" width="200" height="0" style="border: 1px solid rgba(255,255,255,0.2);"></canvas></div>
  </div>
  <div class="row mt-5 mx-auto">
    <div class="col-sm-4 col-md-4">
      <div class="row w-100">
        <div class="offset-sm-3">
          <div class="card-group offset-sm-2" style="width: 11rem">
            <div class="card bg-color2">
              <div class="card-body">
                <h5 class="card-title" >5分钟后开始xx习题</h5>
                <button type="button" class="btn btn-color1">去上课</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4">
      <div class="row w-100">
        <div class="offset-sm-3">
          <div class="card-group offset-sm-2" style="width: 11rem">
            <div class="card bg-color2">
              <div class="card-body">
                <h5 class="card-title">5分钟后开始xx习题</h5>
                <button type="button" class="btn btn-color1">做练习</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4 col-md-4 ">
      <div class="row w-100">
        <div class="offset-sm-2">
          <div class="card-group offset-sm-3" style="width: 11rem">
            <div class="card bg-color2">
              <div class="card-body">
                <h5 class="card-title">5分钟后开始xx习题</h5>
                <button type="button" class="btn btn-color1">去讨论</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/public/js/app.js"></script>

<script type="text/javascript" >


//发布模态框反馈信息
$("#thebutrel").click(function(){
  /*var courid = $("#courid").val();
  var queinfo = $("#thiscourque").val();*/
  $.ajax({
      url:"",
      type:"POST",
      data:{

        '_token':'{{csrf_token()}}',
      },
      success:function(result){
          if(result == 1){
             alert('发布成功'); 
             $('#relepapers').modal('hide');
             window.location.reload();
          }
      },
      error:function(XmlHttpRequest, textStatus, errorThrown){
          alert('发布失败');
      }
  })
})

</script>

</body>

</html>