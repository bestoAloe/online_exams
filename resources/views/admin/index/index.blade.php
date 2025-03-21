<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/public/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/public/admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/public/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/public/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/public/admin/static/h-ui.admin/skin/red/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/public/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/public/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>在线教育后台管理平台</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="">在线教育后台管理平台</a>
			<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
		<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
			<ul class="cl">
				<li>{{Auth::guard('admin') -> user() -> role -> role_name}}</li>
				<li class="dropDown dropDown_hover">
					<a href="#" class="dropDown_A">{{Auth::guard('admin')->user()->username}}<i class="Hui-iconfont">&#xe6d5;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
					   <li><a href="javascript:;" onclick="passwordinfo('密码修改','passwordinfo','500','300')">修改密码</a></li>
						<li><a href="javascript:;" onClick="myselfinfo('个人信息','myselfinfo','','500')">个人信息</a></li>
						<li><a href="{{route('adminlogout')}}">退出</a></li>
				</ul>
			</li>
				<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
						<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
						<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
						<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
						<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
						<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
						<li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
</header>
<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 专业管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="./protype/showlist" data-title="专业分类" href="javascript:void(0)">学院分类</a></li>
			   </ul>
			   <ul>
					<li><a data-href="./profession/showlist" data-title="专业列表" href="javascript:void(0)">专业列表</a></li>
			   </ul>
		   </dd>
	   </dl>
		<dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe626;</i> 课程管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="./course/showlist" data-title="课程管理" href="javascript:void(0)">课程列表</a></li>
					<li><a data-href="./lesson/showlist" data-title="课程管理" href="javascript:void(0)">点播管理</a></li>
					<li><a data-href="./coursearrage/showlist" data-title="课程管理" href="javascript:void(0)">课程安排</a></li>
				</ul>
			</dd>
		</dl>
	<dl id="menu-product">
		<dt><i class="Hui-iconfont">&#xe72d;</i> 试卷试题管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
		<dd>
			<ul>
				<li><a data-href="./testpaper/showlist" data-title="试卷管理" href="javascript:void(0)">试卷管理</a></li>
				<li><a data-href="./exerpaper/showlist" data-title="试题管理" href="javascript:void(0)">试题管理</a></li>
				<li><a data-href="./releasepaper/showlist" data-title="发布管理" href="javascript:void(0)">发布管理</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-comments">
			<dt><i class="Hui-iconfont">&#xe66f;</i> 直播管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="./stream/showlist" data-title="直播列表" href="javascript:;">直播流列表</a></li>
					<li><a data-href="./live/showlist" data-title="直播课程" href="javascript:void(0)">直播课程</a></li>
				</ul>
			</dd>
		</dl>
	<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 答疑管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="./dayi/showlist" data-title="答疑列表" href="javascript:;">答疑列表</a></li>
				</ul>
			</dd>
		</dl>
	<dl id="menu-member">
		<dt><i class="Hui-iconfont">&#xe60d;</i> 学生管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
		<dd>
			<ul>
				<li><a data-href="./students/showlist" data-title="学生列表" href="javascript:;">学生列表</a></li>
			</ul>
		</dd>
	   </dl>
	<dl id="menu-admin">
		<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
		<dd>
			<ul>
				<li><a data-href="./role/showlist" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
				<li><a data-href="./auth/showlist" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>
				<li><a data-href="./manager/showlist" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>
			</ul>
		</dd>
	</dl>
</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active">
					<span title="我的桌面" data-href="welcome">我的桌面</span>
					<em></em></li>
		</ul>
	</div>
	<div class="Hui-tabNav-more btn-group">
		<a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a>
		<a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a>
	</div>
</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe id="iframe-welcome" data-scrolltop="0" scrolling="yes" frameborder="0" src="welcome"></iframe>
	</div>
</div>
</section>

<div class="contextMenu" id="Huiadminmenu">
	<ul>
		<li id="closethis">关闭当前 </li>
		<li id="closeall">关闭全部 </li>
	</ul>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/public/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/public/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/public/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/public/admin/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<script type="text/javascript">
$(function(){
	/*$("#min_title_list li").contextMenu('Huiadminmenu', {
		bindings: {
			'closethis': function(t) {
				console.log(t);
				if(t.find("i")){
					t.find("i").trigger("click");
				}
			},
			'closeall': function(t) {
				alert('Trigger was '+t.id+'\nAction was Email');
			},
		}
	});*/
});

/*密码信息*/
function passwordinfo(title, url, w, h) {
   layer_show(title, url, w, h);
}


/*个人信息*/
function myselfinfo(title, url, w, h){
	layer_show(title, url, w, h);
}

/*课程-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*试卷试题-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}


</script>

</body>
</html>
