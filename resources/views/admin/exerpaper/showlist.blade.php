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
    <title>试题列表</title>
</head>

<body>
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 试题管理 <span class="c-gray en">&gt;</span> 试题列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
        <a href="javascript:;" onclick="location.href='{{ route('exerexport')}}'" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe644;</i> 导出试题</a>
        <a href="javascript:;" onclick="imppaper('导入试题','import','800','400')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe645;</i> 导入试题</a>
        </div>
        <table class="table table-border table-bordered table-bg">
            <thead>
                <tr>
                    <th scope="col" colspan="9">试题列表</th>
                </tr>
                <tr class="text-c">
                    <th width="25"><input type="checkbox" name="" value=""></th>
                    <th width="40">ID</th>
                    <th width="120">题干</th>
                    <th width="90">所属试卷</th>
                    <th width="40">分值</th>
                    <th width="140">选项</th>
                    <th width="40">答案</th>
                    <th width="100">创建时间</th>
                    <th width="80">操作</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($data as $val)
                <tr class="text-c">
                    <td><input type="checkbox" value="{{$val->id}}" name=""></td>
                    <td>{{$val->id}}</td>
                    <td>{{$val->exerpaper_name}}</td>
                    <td>{{$val->reatestpaper -> testpaper_name}}</td>
                    <td>{{$val->score}}</td>
                    <td><a href="javascript:;" onclick="showOptions('{{$val->options}}')"><b>查看选项</b></a></td>
                    <td>{{$val->answer}}</td>
                    <td>{{$val->created_at}}</td>
                    <td class="td-manage">
                        <a title="编辑" href="javascript:;" onclick="exerpaper_edit('试题编辑','admin-add.html','1','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                        <a title="删除" href="javascript:;" onclick="exerpaper_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
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
   /*试题-选项查看*/
    function showOptions(options) {
        //按照~进行分割选项
        var arr = options.split("~");
        //循环
        var opt = '';
        for (var i = 0; i < arr.length; i++) {
            opt += arr[i] + '<br/>';
        }
        layer.alert(opt);
    }

    /*试题-导入*/
    function imppaper(title, url, w, h) {
        layer_show(title, url, w, h);
    }

    /*试题-增加*/
    function exerpaper_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*试题-删除*/
    function exerpaper_del(obj, id) {
        layer.confirm('确认要删除吗？', function(index) {
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', { icon: 1, time: 1000 });
                },
                error: function(data) {
                    console.log(data.msg);
                },
            });
        });
    }

    /*试题-编辑*/
    function exerpaper_edit(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*试题-停用*/
    function exerpaper_stop(obj, id) {
        layer.confirm('确认要停用吗？', function(index) {
            //此处请求后台程序，下方是成功后的前台处理……

            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="exerpaper_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
            $(obj).remove();
            layer.msg('已停用!', { icon: 5, time: 1000 });
        });
    }

    /*试题-启用*/
    function exerpaper_start(obj, id) {
        layer.confirm('确认要启用吗？', function(index) {
            //此处请求后台程序，下方是成功后的前台处理……


            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="exerpaper_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
            $(obj).remove();
            layer.msg('已启用!', { icon: 6, time: 1000 });
        });
    }
    </script>
</body>

</html>