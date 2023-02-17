<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/public/css/app.css"/>

    <title>在线教学平台登录入口</title>

    <style>
      body {
        width: 100%;
        height: 100%;
        background-color: #6d8e97;
      }
      .toubu {
          width: 70%;
          height: 50%;
          margin:11% auto;
      }
      .butbg_color{
        background-color: #596f90;
      }

      .inbg_color1{
        background-color: #d9abb4;
      }

      .opacities{
        opacity:0.8;
      }
    </style>
</head>

<body>
<div class="container-fluid">
  <div class="toubu">
    <div class="row rounded">
      <div class="col my-3 ">
        <img class="rounded-left ml-5 " src="images/welcome_bg1.jpg" width="100%" height="100%">
      </div>
      <div class="col my-3">
        <div class="card mr-5 inbg_color1">
          <div class="card-body">
            <form action="{{route('logincheck')}}" method="POST">
              <div class="form-group">
               <input class="form-control" type="text" name="stu_name" placeholder="用户名">
              </div>
              <div class="form-group">
                 <input class="form-control " type="password" name="password" placeholder="密码">
              </div>
              <div class="form-group">
                <input name="captcha" class="form-control float-left w-50" type="text" placeholder="验证码" onclick="if(this.value=='验证码:'){this.value='';}" style="width:150px;">
                <img id="captchas" class="ml-1 rounded" src="{{captcha_src();}}"> <a id="kanbuq" href="javascript:;">换一张</a> 
              </div>
              {{csrf_field()}}
              <div class="form-group">
                <div class="form-control">
                  <label for="online"><input type="checkbox" name="online" id="online" value="1">
                  使我保持登录状态</label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">登录</button>
              <a href="{{route('adminLogin')}}" type="button" class="btn btn-secondary">管理员登录</a>
            </form>
          </div>
        </div>
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
//验证码
$(function(){
  //给kanhbug点击事件
  //获取验证码地址
  var src = $('#captchas').attr('src');
  $('#kanbuq').click(function(){
    $('#captchas').attr('src',src + '&_=' + Math.random());
  });

  //以javascript弹窗形式输出错误的内容
  @if (count($errors) > 0)
    var allError = '';
    @foreach ($errors->all() as $error)
      allError += "{{$error}}";
    @endforeach
    //输出错误的提示
    alert(allError,{titile:'错误提示',icon:5});
  @endif
});

 //背景图片切换
 window.onload = function () {
 
  setInterval(step, 1000);
 }
 var num = 1;
 function step() {
  if (num < 5) {
   num++;
  } else {
   num = 1;
  }
  var dom = document.getElementById("imgId");
  //更改它images的src属性
  dom.src = 'img/' + num + '.jpg';
 }

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