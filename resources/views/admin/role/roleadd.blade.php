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
<title>添加角色</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
	<div class="row cl">
		<label class="form-label col-sm-3 col-xs-3"><span class="c-red">*</span>角色名称：</label>
		<div class="formControls col-xs-7 col-sm-6">
			<input type="text" class="input-text" value="" placeholder="" id="role_name" name="role_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-9 col-sm-10 col-xs-offset-1">注：添加角色成功后记得列表分配所需要的权限哦</label>
	</div>

	<!--csrf隐藏域-->
	{{csrf_field()}}
	<div class="row cl">
		<div class="col-xs-6 col-sm-7 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="/public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/public/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/public/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/public/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/public/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/public/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
	
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-add").validate({
		rules:{
			role_name:{
				required:true,
				minlength:2,
				maxlength:16
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "" ,  //自己提交给自己不加url
				success: function(data){
					//判断添加结果
					if (data == '1') {
						layer.msg('添加成功!',{icon:1,time:2000},function(){
						   var index = parent.layer.getFrameIndex(window.name);
					      //parent.$('.btn-refresh').click();
					      parent.window.location = parent.window.location;
					      parent.layer.close(index);
					   });
					}else{
						layer.msg('添加失败!',{icon:2,time:2000},function(){
						   var index = parent.layer.getFrameIndex(window.name);
					   });
					}
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('error!',{icon:1,time:1000},function(){
						var index = parent.layer.getFrameIndex(window.name);
						//请求后是否关闭弹窗
					   //parent.$('.btn-refresh').click();
					   //parent.layer.close(index);
					});
				}
			});
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>