<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
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
<title>学院分类管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 学院分类管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="protype_add('添加学院分类节点','addprotype','','400')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加学院分类</a></span></div>
    <table class="table table-border table-bordered table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="7">学院分类节点</th>
            </tr>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="40">ID</th>
                <th width="150">学院分类名称</th>
                <th width="150">排序</th>
                <th width="150">创建时间</th>
                <th width="150">状态</th>
                <th width="100">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $val)
            <tr class="text-c">
                <td><input type="checkbox" value="{{$val -> id}}" name=""></td>
                <td>{{$val -> id}}</td>
                <td>{{$val -> protype_name}}</td>
                <td>{{$val -> sort}}</td>
                <td>{{$val -> created_at}}</td>
                <td>@if($val -> status == '1') 禁用 @else 启用 @endif </td>
                <td><a title="编辑" href="javascript:;" onclick="admin_permission_edit('角色编辑','admin-permission-add.html','1','','310')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_permission_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/public/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/public/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/public/admin/lib/datatables/1.10.15/jquery.dataTables.min.js"></script> 
<script type="text/javascript">
//jquery的页面载入事件
$(function(){
    //实例化dt
    $('table').dataTable({
        //禁用掉第一列复选框的排序
      "aoColumnDefs": [{"bSortable": false, "aTargets":[0]}],
      //默认在初始化时按照哪一列排序
      "aaSorting": [[1,"asc"]]
    });
})
/*
    参数解释：
    title   标题
    url     请求的url
    id      需要操作的数据id
    w       弹出层宽度（缺省调默认值）
    h       弹出层高度（缺省调默认值）
*/
/*管理员-学院分类-添加*/
function protype_add(title,url,w,h){
    layer_show(title,url,w,h);
}
/*管理员-学院分类-编辑*/
function admin_permission_edit(title,url,id,w,h){
    layer_show(title,url,w,h);
}

/*管理员-学院分类-删除*/
function admin_permission_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url: '',
            dataType: 'json',
            success: function(data){
                $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:1000});
            },
            error:function(data) {
                console.log(data.msg);
            },
        });     
    });
}
</script>
</body>
</html>