<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/public/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="/public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <script src="https://cdn.bootcss.com/flv.js/1.3.2/flv.min.js"></script>
    
    <title>课程直播</title>
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
    <script src="http://vjs.zencdn.net/5.20.1/videojs-ie8.min.js"></script>
</head>

<body>
<div class="container-fluid">
  <div class="toubu my-3">
    <div class="row mt-3">
      <div class="col-sm-3 offset-sm-4">
        <form action="{{ route('courzhibo') }}" method="post" id="autosubmit">
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
    <div class="row mt-5 row-cols-2" h-75>
      <div class="col-sm-10">
        <video  id="courvideos" src="{{$lookurl}}" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width="100%" autoplay="autoplay">
          <source src="{{$lookurl}}" type="rtmp/flv">
          <p>您的浏览器不支持 video 标签。</p>
        </video>
        <div class="mt-2">
          <h4 id="courname"></h4>
          <div>
            <div class="font-weight-bold">上课时间</div>
            <small>10：00 - 12：00</small>
          </div>
          <div class="mt-2">
            <div class="font-weight-bold">讨论区：</div>
            <div class="row" height="100px">
              <div class="col-sm-7">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item list-group-item-light bg-color1 rounded">
                    <small class="col font-italic">畅雪 <span class="badge badge-primary">学生</span>
                    </small><span class="text-dark overflow-auto ml-3">开始上课了吗？</span>
                  </li>
                  <li class="list-group-item list-group-item-light bg-color1 rounded">
                    <small class="col font-italic"> admin <span class="badge badge-success" >老师</span>
                    </small><span class="text-dark overflow-auto ml-3">开始上课</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-2 mt-2">
        <div class="float-right text-decoration-none overflow-auto coursvie">
          <div class="font-weight-bold mb-3">课程选集</div>
        @foreach($reladdr as $tmp)
          <div class="mt-2"><a class="text-dark" href="javascript:0;" onclick="changecourinfo('{{$tmp->lesson_name}}','{{$tmp->video_addr}}');">p{{$num++}}-{{$tmp->lesson_name}}</a></div>
        @endforeach
          <div class="mt-2"><a class="text-dark" href="javascript:0" onclick="gozhibo('{{$lookurl}}')"><i class="Hui-iconfont">&#xe601;</i>正在直播</a></div>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>

<script type="text/javascript" src="/public/js/app.js"></script>
<script type="text/javascript" >

//播放控制


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

function gozhibo($url){
  //alert($url);
  //document.getElementById("courvideos").src = $url;
  document.getElementById("courname").innerHTML = '点击进入直播间';

  if (flvjs.isSupported()) {
    var videoElement = document.getElementById('courvideos');
    var flvPlayer = flvjs.createPlayer({
        type: 'flv',
        url: $url
    });
    flvPlayer.attachMediaElement(videoElement);
    flvPlayer.load();
    flvPlayer.play();
  }

  // videojs.options.flash.swf = 'https://cdn.bootcss.com/videojs-swf/5.4.1/video-js.swf';
  // var player = videojs('courvideos',{
  //   autoplay:true,
  //   controls:true,  //控制条
  //   techOrder:["flash"],  //设置flash播放
  //   muted:true,  //静音
  //   playbackRates:1,  //播放速度
  // },function(){
  //   console.log("成功初始化视频");
  //   player.one("playing",function(){
  //     console.log("开始播放");
  //   });
  //   player.one("error",function(){
  //     console.log("异常:%o",error);
  //   });
  // });
}

//课程自动提交表单
function submitform(){
  var form = document.getElementById('autosubmit');

  form.submit();
}

</script>

</body>

</html>