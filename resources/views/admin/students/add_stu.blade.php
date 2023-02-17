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
<title>添加学生</title>
<meta name="keywords" content="添加学生">
<meta name="description" content="添加学生">
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>学生：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="stu_name" name="stu_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off"  placeholder="确认新密码" id="password2" name="password2">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="gender" type="radio" id="gender-1" value="1" checked>
				<label for="gender-1">男</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="gender-2" name="gender" value="2">
				<label for="gender-2">女</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="gender-3" name="gender" value="3">
				<label for="gender-3">保密</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="mobile" name="mobile">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="@" name="email" id="email">
		</div>
	</div>
	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">所属专业：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
			   <span class="select-box">
				<select class="select" size="1" name="bel_profession">
					<option value="0" selected>请选择专业</option>
					@foreach($data as $val)
					<option value="{{$val->id}}">{{$val -> profession_name}}</option>
					@endforeach
				</select>
				</span> 
			</div>
		</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号状态：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="status" type="radio" id="status-1" value="2" checked>
				<label for="status-1">启用</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="status-2" name="status" value="1" >
				<label for="status-2">禁用</label>
			</div>
		</div>
	</div>
	{{csrf_field()}}
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
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
			stu_name:{
				required:true,
				minlength:2,
				maxlength:10
			},
			password:{
				required:true,
			},
			password2:{
				required:true,
				equalTo: "#password"
			},
			gender:{
				required:true,
			},
			mobile:{
				required:true,
				isPhone:true,
			},
			email:{
				required:true,
				email:true,
			},
			bel_profession:{
				required:true,
			},
			status:{
				required:true,
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
					layer.msg('error!',{icon:2,time:1000},function(){
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