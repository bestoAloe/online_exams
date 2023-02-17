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
<title>添加直播课程</title>
<meta name="keywords" content="添加直播课程">
<meta name="description" content="添加直播课程">
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
				<select class="select" name="protype_id" size="1">
					<option value="0">学院</option>
					@foreach($data as $val)
					   <option value="{{$val -> id}}">{{$val -> protype_name}}</option>
					@endforeach
				</select>
				</span> 
				<span class="select-box ml-15" style="width:150px;">
				<select class="select" name="profession_id" size="1">
					<option value="">专业</option>
				</select>
				</span> 
				<span class="select-box ml-15" style="width:150px;">
				<select class="select" name="course_id" size="1">
					<option value="">课程</option>
				</select>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>直播流：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
				<select class="select" name="stream_id" size="1">
					<option value="0"></option>
					@foreach($tmp as $val2)
					   <option value="{{$val2 -> id}}">{{$val2 -> stream_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"  name="description" id="description">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程开始时间：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="datetime-local" class="input-text"  placeholder="" id="begin_at" name="begin_at">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程结束时间：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="datetime-local" class="input-text"  placeholder="" id="end_at" name="end_at">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
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

$('select[name=protype_id]').change(function(){
  //获取当前学院id
  var protype_id = $(this).val();
  $.get('./admgetprotyid',{protype_id:protype_id},function(prof){
    //jquery的循环操作
    let str = '';
    $.each(prof,function(index,el){
      str += "<option value='" + el.id + "'>" + el.profession_name + "</option>";
    });
    
     //console.log(str);
    //首先清除之前的二级下的数据
    $('select[name=profession_id]').find('option:gt(0)').remove();
    //将数据放到对应的option之后
    $('select[name=profession_id]').append(str);

  },'json');

})

$('select[name=profession_id]').change(function(){
  //获取当前学院id
  var profession_id = $(this).val();
  $.get('./admgetfessid',{profession_id:profession_id},function(prof){
    //jquery的循环操作
    let str = '';
    $.each(prof,function(index,el){
      str += "<option value='" + el.id + "'>" + el.course_name + "</option>";
    });
    
     //console.log(str);
    //首先清除之前的二级下的数据
    $('select[name=course_id]').find('option:gt(0)').remove();
    //将数据放到对应的option之后
    $('select[name=course_id]').append(str);

  },'json');

})

$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-add").validate({
		rules:{
			protype_id:{
				required:true,
			},
			profession_id:{
				required:true,
			},
			course_id:{
				required:true,
			},
			stream_id:{
				required:true,
			},
			description:{
				required:true,
			},
			begin_at:{
				required:true,
			},
			end_at:{
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
				type: 'POST',
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