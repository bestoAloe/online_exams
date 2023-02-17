<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/public/css/app.css"/>
    

    <title>视频录播</title>
    <style>

      video::-webkit-media-controls-current-time-display{display: none;}

      body {
        background-color: #a6bfc6;
      }
      .toubu{
        width: 70%;
        height: auto;
        margin: auto;
      }
      .coursvie{
        width: 100%;
        height: 350px;
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
      
    </style>
</head>

<body>
<div class="container-fluid">
  <div class="toubu my-3">
    <div class="row mt-2">
      <div class="col-sm-3 offset-sm-4">
        <form action="{{ route('videolubo') }}" method="post" id="autosubmit">
        @csrf
          <select class="form-control form-control-lg" name="course_id" onchange="submitform();">
            @if($courid == '') 
            <option value="0" selected>选择课程</option>
            @endif
            @foreach($courdata as $val)
            @if($val->reathecourse->id == $courid)
            <option value="{{$val->reathecourse->id}}" selected>{{$val->reathecourse->course_name}}</option>
             <?php continue; ?>
            @endif
            <option value="{{$val->reathecourse->id}}">{{$val->reathecourse->course_name}}</option>
            @endforeach
          </select>
        </form>
      </div>
    </div>
    @if($reladdr != '')
    <div class="row mt-5 row-cols-2">
      <div class="col-sm-10">
        <div width="100%" >
          <video  id="courvideos" src="" object-fit  controls width="100%" height="100%" controlsList = "nodownload">
          您的浏览器不支持 video 标签。
          </video>
        </div>
        <div class="mt-2">
          <h4 id="courname"></h4>
          <div>
            <div class="font-weight-bold">课程主要内容:</div>
            <small>1.掌握基本语法 2.掌握基本语法 3.掌握基本语法 4.掌握基本语法</small>
          </div>
          <div class="mt-2">
            <div class="font-weight-bold">笔记:</div>
            <div>1 隐藏域在页面中对于用户是不可见的，在表单中插入隐藏域的目的在于收集或发送信息，以利于被处理表单的程序所使用。浏览者单击发送按钮发送表单的时候，隐藏域的信息也被一块儿发送到服务器。2 有些时候咱们要给用户一信息，让他在提交表单时提交上来以肯定用户身份，如sessionkey，等等．固然这些东西也能用cookie实现，但使用隐藏域就简单的多了．并且不会有浏览器不支持，用户禁用cookie的烦恼。3 有些时候一个form里有多个提交按钮，怎样使程序可以分清楚到底用户是按那一个按钮提交上来的呢？咱们就能够写一个隐藏域，而后在每个按钮处加上οnclick="document.form.command.value="xx""而后咱们接到数据后先检查command的值就会知道用户是按的那个按钮提交上来的。</div>
          </div>
        </div>
      </div>
      <div class="col-sm-2 mt-2">
        <div class="float-right text-decoration-none overflow-auto coursvie">
          <div class="font-weight-bold mb-3">视频选集</div>
        @foreach($reladdr as $tmp)
          <div class="mt-2"><a class="text-dark" href="javascript:0;" onclick="changecourinfo('{{$tmp->lesson_name}}','{{$tmp->video_addr}}');">p{{$num++}}-{{$tmp->lesson_name}}</a></div>
        @endforeach
        </div>
      </div>
    </div>
    @endif
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


function changecourinfo($coursename,$video_addr)
{
  //获取视频地址封面地址
  $video_addr = $video_addr.substr(3);
  //alert($coursename+$video_addr+$cover_img);  
  //$(this).style = "color:#33333";
  //在javascript里替换html元素
  document.getElementById("courvideos").src = $video_addr;
  document.getElementById("courname").innerHTML = $coursename;
}

//课程自动提交表单
function submitform(){
  var form = document.getElementById('autosubmit');

  form.submit();
}

</script>

</body>

</html>