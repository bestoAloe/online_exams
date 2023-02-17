<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/public/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="/public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />

    <title>教育在线</title>
     <style>
      body {
        background-color: #a6bfc6;
      }
      .toubu{
        width: 70%;
        height: auto;
        margin: auto;
      }
      .zhongbu{
        width: 70%;
        height: 80vh;
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
        background-color: #FBC9D3;
        border-color: 1px  solid rgba(240, 240, 240, 0.5);
      }

      .border-my {
        border-color: #eee !important;
      }

      .narbg{
        background-color: #edbec7 !important;
      }
      

    </style>
</head>

<body>
<div class="container-fluid ">
  <div class="toubu">
    <div class="row">
      <div class="col-sm-12">
        <nav class="navbar navbar-expand-sm sticky-top navbar-light narbg">
          <div class="col-sm-1"><div class="offset-sm-9">LOGO</div></div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse offset-sm-3" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="{{route('courzhibo')}}" target="_blank"><i class="Hui-iconfont">&#xe720;</i> 课程直播</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('videolubo')}}" target="_blank"><i class="Hui-iconfont">&#xe720;</i>视频录播</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('exerpaperlist')}}" target="_blank"><i class="Hui-iconfont">&#xe720;</i>考试练习</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('coursedayi')}}" target="_blank"><i class="Hui-iconfont">&#xe720;</i>课程答疑</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-expanded="false"><i class="Hui-iconfont">&#xe636;</i></i>课程管理
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                  <a class="dropdown-item" href="{{route('courhave')}}" target="_blank">已选课程</a>
                  <a class="dropdown-item" href="{{route('selcourse')}}" target="_blank">去选课</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  <i class="Hui-iconfont">&#xe602;</i>个人信息
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" data-toggle="modal" data-target="#stupassModal" href="#">修改密码</a>
                  <a class="dropdown-item" data-toggle="modal" data-target="#stuinfoModal" href="#">其他信息查看</a>
                  <a class="dropdown-item" id="#stu_quit" href="{{route('logout')}}">退出</a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <!-- 个人信息模态框 -->
    <div class="modal fade" id="stuinfoModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">个人信息</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="stuinfo" action="" method="POST">
            <div class="modal-body">
              <div class="overflow-auto container-fluid">
                <input type="hidden" name="thisqueid" id="" value="">
              <!-- <script id="editor" class="" type="text/plain" style="width:100%;height:60%;"></script> -->
                <div class="row mt-1 row-cols-2">
                  <div class="col-sm-6">
                    <label><span style="color:red">*</span>姓名</label><br>
                    <input type="text" id="stu_name" name="stu_name" value="{{$data[0]['stu_name']}}"> 
                  </div>
                  <div class="col-sm-6">
                    <label><span style="color:red">*</span>性别</label><br>
                    <input type="radio"  name="gender" value="1" @if($data[0]['gender'] == '1') checked="checked" @endif width= 80%>男
                    <input type="radio"  name="gender" value="2"  @if($data[0]['gender'] == '2') checked="checked" @endif width= 80%>女
                    <input type="radio"  name="gender" value="3"  @if($data[0]['gender'] == '3') checked="checked" @endif width= 80%>保密
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-sm-6">
                    <label><span style="color:red">*</span>电话</label><br>
                    <input type="text" id="stu_mbolie" name="mobile" value="{{$data[0]['mobile']}}" width= 80%> 
                  </div>
                  <div class="col-sm-6">
                    <label><span style="color:red">*</span>邮箱</label><br>
                    <input type="email" id="stu_email" name="email" value="{{$data[0]['email']}}" width= 80%> 
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-sm-6">
                    <label><span style="color:red">*</span>专业</label><br>
                    <input type="text" id="stu_profession" name="bel_profession" value="{{$data[0]['bel_profession']}}" width= 80% readonly="readonly"> 
                  </div>
                </div>
              </div>   
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
              <button type="button" id="sendinfo"  class="btn btn-primary">保存</button>
            </div>
          </form>
        </div>
      </div>
    </div>
     <!-- 密码模态框 -->
    <div class="modal fade" id="stupassModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel2">修改登录密码</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="pasinfo" class="was-validated" action="" method="POST">
            <div class="modal-body">
              <div class="overflow-auto container-fluid">
              <!-- <script id="editor" class="" type="text/plain" style="width:100%;height:60%;"></script> -->
                <div class="row mt-1 input-group has-validation">
                  <div class="col-sm-8 offset-sm-1">
                    <label><span style="color:red">*</span>原密码</label>
                    <input class="form-control" type="password" name="passwordOld" required pattern="[a-zA-Z0-9]{4,}">
                    <div class="invalid-feedback">
                      密码长度或字符不符合
                    </div>
                  </div>
                </div>
                <div class="row mt-2 input-group has-validation">
                  <div class="col-sm-8 offset-sm-1">
                    <label><span style="color:red">*</span>新密码</small></label>
                    <input id="passwordNew" class="form-control" type="password" onkeyup="checkpassword()" placeholder="密码至少六个字符" name="passwordNew" required pattern="[a-zA-Z0-9]{6,}" value="">
                    <div class="invalid-feedback">
                      密码长度或字符不符合
                    </div>
                  </div>
                </div>
                <div class="row mt-2 input-group has-validation">
                  <div class="col-sm-8 offset-sm-1">
                    <label><span style="color:red">*</span>新密码-防输错</label>
                    <input id="passwordNew2" class="form-control" type="password" onkeyup="checkpassword()" placeholder="密码至少六个字符" name="passwordNew2" required pattern="[a-zA-Z0-9]{6,}" value="">
                    <div class="invalid-feedback">
                      密码长度或字符不符合
                    </div>
                    <span id="tishi"></span>
                  </div>
                </div>
              </div>   
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
              <button type="button" id="passinfo"  class="btn btn-primary">保存</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="zhongbu">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/bg05.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>腹有诗书气自华，读书万卷始通神。 —— 苏轼</h5>
            <p>There is poetry and bookishness in the belly, and reading thousands of volumes begins to understand the gods.  —— Su Shi</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="images/bg04.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>读书而不思考，等于吃饭而不消化。 —— 波尔克</h5>
            <p>Reading without thinking is equivalent to eating without digesting.  — Polk</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="images/bg03.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>千里之行，始于足下。—— 老子</h5>
            <p>Great oaks from little acorns grow.. —— Lao Tzu</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </button>
    </div>
  </div>
  <div class="xiabu mt-5 mb-2">
    <div class="row">
      <div class="col-sm-12">
        <div class="card-group">
          <div class="card">
            <img src="images/welcome_bg2.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">5分钟英文短文</h5>
              <p class="card-text">Grow Great by Dreams</p>
              <p class="card-text">The question was once asked of a highly successful businessman, "How have ...</p>
            </div>
            <div class="card-footer">
              <a type="button" class="btn btn-color1" href="{{route('zhognbufujia','1')}}">点击进入</a>
            </div>
          </div>
          <div class="card">
            <img src="images/welcome_bg2.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">5分钟大学故事</h5>
              <p class="card-text">北京地铁和大学的故事（一）</p>
              <p class="card-text" >众所周知，北京有很多高校。但是有趣的是，虽然地铁很早就开始修，但经过西...</p>
            </div>
            <div class="card-footer">
              <a type="button" class="btn btn-color1"  href="{{route('zhognbufujia','2')}}">点击进入</a>
            </div>
          </div>
          <div class="card">
            <img src="images/welcome_bg2.jpg" class="card-img-top" alt="...">
           <div class="card-body">
              <h5 class="card-title">阅读推荐</h5>
              <p class="card-text">《活着》  ---余华</p>
              <p class="card-text">被认为是还没有阅读习惯的同学的必备书籍，因为一旦拿起这本书，往往一口气...</p>
            </div>
            <div class="card-footer">
              <a type="button" class="btn btn-color1"  href="{{route('zhognbufujia','3')}}">点击进入</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/public/js/app.js"></script>

<script type="text/javascript" >
//个人模态框反馈信息
$("#sendinfo").click(function(){
  $.ajax({
      url:"{{route('shoupage')}}",
      type:"POST",
      headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      },
      data:$('#stuinfo').serialize(),
      success:function(result){
          if(result == 1){
             alert('保存成功'); 
             $('#stupassModal').modal('hide');
             window.location.reload();
          }
      },
      error:function(XmlHttpRequest, textStatus, errorThrown){
          alert('保存失败');
      }
  })
})

//密码模态框反馈信息
$("#passinfo").click(function(){
  $.ajax({
      url:"{{route('checkpas')}}",
      type:"POST",
      headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      },
      data:$('#pasinfo').serialize(),
      success:function(result){
          if(result == 1){
             alert('修改成功'); 
             $('#stuinfoModal').modal('hide');
             window.location.reload();
          }
          if(result == 2){
             alert('原密码不正确'); 
          }
      },
      error:function(XmlHttpRequest, textStatus, errorThrown){
          alert('修改失败');
      }
  })
})

//判断两个新密码是否相同
function checkpassword() {
  var password = document.getElementById("passwordNew").value;
  var repassword = document.getElementById("passwordNew2").value;

  if(password == repassword) {
      document.getElementById("tishi").innerHTML="<br><font color='green'>新密码输入一致</font>";
      document.getElementById("passinfo").disabled = false;

  }else {
      document.getElementById("tishi").innerHTML="<br><font color='red'>新密码输入不一致!</font>";
      document.getElementById("passinfo").disabled = true;
  }
}

</script>

</body>

</html>