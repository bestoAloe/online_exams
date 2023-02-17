<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
<script type="text/javascript" src="/public/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/public/admin/lib/respond.min.js"></script>
<![endif]-->
    <link rel="stylesheet" type="text/css" href="/public/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/public/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/public/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/public/admin/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
<script type="text/javascript" src="/public/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
    <title>直播课程列表</title>
</head>

<body>
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 直播课程管理 <span class="c-gray en">&gt;</span> 直播课程列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
        <a href="javascript:;" onclick="addlive('添加直播','addlive','','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加直播课程</a></span></div>
        <table class="table table-border table-bordered table-bg">
            <thead>
                <tr>
                    <th scope="col" colspan="13">直播课程列表</th>
                </tr>
                <tr class="text-c">
                    <th width="25"><input type="checkbox" name="" value=""></th>
                    <th width="40">ID</th>
                    <th width="80">直播课程名</th>
                    <th width="90">所属专业</th>
                    <th width="100">所属直播流</th>
                    <th width="80">封面</th>
                    <th width="130">描述</th>
                    <th width="100">开始时间</th>
                    <th width="100">结束时间</th>
                    <th width="100">直播地址</th>
                    <th width="50">直播回放</th>
                    <th width="100">状态</th>
                    <th width="100">操作</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($data as $val)
                <tr class="text-c">
                    <td><input type="checkbox" value="{{$val->id}}" name="adminids"></td>
                    <td>{{$val->id}}</td>
                    <td>{{$val->live_name}}</td>
                    <td>{{$val->reatoprof->profession_name}}</td>
                    <td>{{$val->reatostream->stream_name}}</td>
                    <td>{{$val->cover_img}}</td>
                    <td>{{$val->description}}</td>
                    <td>{{date('Y-m-d H-i-s',$val->begin_at)}}</td>
                    <td>{{date('Y-m-d H-i-s',$val->end_at)}}</td>
                    <td><a href="javascript:;" onclick="showaddr('{{$val->video_addr}}')"><b>查看链接</b></a></td>
                    <td>
                    <a href="javascript:0;" onclick="seeback('{{$val->reatostream->stream_name}}')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe641;</i>回放链接</a>
                    </td>
                    <td class="td-status">
                        @if($val -> status == '2')
                        <span class="label label-success radius">已启用</span>
                        @else
                        <span class="label radius">已停用</span>
                        @endif
                    </td>
                    <td class="td-manage">
                        @if($val -> status == '2')
                        <a style="text-decoration:none" onClick="live_stop(this,'{{$val->id}}','1')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
                        @else
                        <a style="text-decoration:none" onClick="live_start(this,'{{$val->id}}','2')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a>
                        @endif
                        <a title="编辑" href="javascript:;" onclick="live_edit('直播编辑','','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                        {{csrf_field()}}
                        <a title="发布直播" href="javascript:;" onclick="fabu_live(this,'{{$val->id}}','{{$val->reatostream->stream_name}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe603;</i></a>
                    </td>
                </tr>
               @endforeach

            </tbody>
        </table>
    </div>
    <!--_footer 作为公共模版分离出去-->
    <script type="text/javascript" src="/public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/public/admin/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/public/admin/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/public/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
    <!--/_footer 作为公共模版分离出去-->
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/public/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/public/admin/lib/datatables/1.10.15/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/public/admin/lib/laypage/1.2/laypage.js"></script>
    <script type="text/javascript">
    //实例化datatables插件
    $('table').dataTable({
        //禁用掉第一列复选框的排序
        "aoColumnDefs": [{"bSortable": false, "aTargets":[0]}],
        //默认在初始化时按照哪一列排序
        "aaSorting": [[1,"asc"]]
    });
    /*
	  参数解释：
	  title	标题
	  url		请求的url
	  id		需要操作的数据id
	  w		弹出层宽度（缺省调默认值）
	  h		弹出层高度（缺省调默认值）
    */
   //直播回放下载
   function seeback(name){
    //
     $.ajax({
        type: 'POST',
        url: 'showlist',
        dataType: 'json',
        data:{
            'live_name':name,
            '_token':'{{csrf_token()}}'
        },
        success: function(data) {
            //let url = '<%= session.getAttribute["'+name+'"] %>';
            alert('回放链接：'+ data['url']);
        },
        error: function(data) {
            layer.msg('下载失败! 生成回放需要时间,请稍后再尝试。', { icon: 2, time: 3000 });
            //console.log(data.msg);
        },
    });
   }

   //查看链接
   function showaddr(addr) {
        //按照~进行分割选项
        var arr1 = addr.indexOf("服");
        var arr2 = addr.indexOf("串");
        var arr3 = addr.indexOf("观");
        //循环
        var opt = addr.slice(arr1,arr2)+'<br/>'+addr.slice(arr2,arr3)+'<br/>'+addr.slice(arr3);
        layer.alert(opt);
    }

    /*直播-增加*/
    function addlive(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*直播-发布*/
    function fabu_live(obj,id,stream) {
        $.ajax({
            type: 'POST',
            url: 'fabulive',
            dataType: 'json',
            data:{
                'id':id,
                'stream_name':stream,
                '_token':'{{csrf_token()}}'
            },
            success: function(data) {
                $(obj).parents("tr").remove();
                layer.msg('发布成功!', { icon: 1, time: 1000 });
                window.location = window.location;
            },
            error: function(data) {
                layer.msg('发布失败!', { icon: 2, time: 1000 });
                console.log(data.msg);
            },
        });
    }
    

    /*直播-编辑*/
    function live_edit(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*直播-停用*/
    function live_stop(obj, id,orderid) {
        layer.confirm('确认要停用吗？', function(index) {
            $.ajax({
                type: 'POST',
                url: 'deal_admin/'+id,
                dataType: 'json',
                data:{
                    'orderid':orderid,
                    '_token':'{{csrf_token()}}',
                },
                success: function(data) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="live_start(this,'+id+',2)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已停用</span>');
                    $(obj).remove();
                    layer.msg('已停用!', { icon: 1, time: 1000 });
                    //parent.window.location = parent.window.location;
                },
                error: function(data) {
                    layer.msg('操作失败!', { icon: 2, time: 1000 });
                    console.log(data.msg);
                },
            });

            
        });
    }

    /*直播-启用*/
    function live_start(obj, id,orderid) {
        layer.confirm('确认要启用吗？', function(index) {
            $.ajax({
                type: 'POST',
                url: 'deal_admin/'+id,
                dataType: 'json',
                data:{
                    'orderid':orderid,
                    '_token':'{{csrf_token()}}'
                },
                success: function(data) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="live_stop(this,'+id+',1)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!', { icon: 1, time: 1000 });
                    //parent.window.location = parent.window.location;
                },
                error: function(data) {
                    layer.msg('操作失败!', { icon: 2, time: 1000 });
                    console.log(data.msg);
                },
            });
            //此处请求后台程序，下方是成功后的前台处理……


            
        });
    }
    </script>
</body>

</html>