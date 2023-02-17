<?php
use App\Http\Controllers\Students;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//后台路由部分(不需要身份权限验证)
Route::group(['prefix'=>'admin','name' => 'admin.'],function(){

	//后台登录页面
	Route::get('/login',[Admin\PublicController::class,'login']) -> name('adminLogin');

	//后台登录处理页面
	Route::post('/check',[Admin\PublicController::class,'check'])-> name('checkadmlogin');

	//后台退出
	Route::get('/logout',[Admin\PublicController::class,'logout']) -> name('adminlogout');

});

//后台路由部分(需要身份权限验证)
Route::group(['name' => 'admin.', 'middleware' => ['auth:admin','checkrbac']],function(){

	//后台首页路由
	Route::get('/index',[Admin\IndexController::class,'index']) -> name('HouShou');
	Route::get('/welcome',[Admin\IndexController::class,'welcome']);
	Route::match(['get', 'post'],'/passwordinfo',[Admin\IndexController::class,'passwordinfo']) -> name('paswodinfo');
	Route::match(['get', 'post'],'/myselfinfo',[Admin\IndexController::class,'myselfinfo']) -> name('myselfinfo');

	//管理员管理
	Route::match(['get', 'post'],'/manager/showlist',[Admin\ManagerController::class,'showlist']);

	Route::any('/manager/add_admin',[Admin\ManagerController::class,'add_admin']);
	Route::any('manager/deal_admin/{id}',[Admin\ManagerController::class,'deal_admin']);
	Route::any('manager/edit_admin/{id}',[Admin\ManagerController::class,'edit_admin'])->name('edit_admin');

	//权限管理模块
	Route::any('/auth/showlist',[Admin\AuthController::class,'showlist']);
	Route::any('/auth/addau',[Admin\AuthController::class,'addau']);
	Route::any('/auth/edit_auth/{id}',[Admin\AuthController::class,'edit_auth'])->name('edit_auth');

   //角色管理模块
	Route::any('/role/showlist',[Admin\RoleController::class,'showlist']);
	Route::any('/role/assign',[Admin\RoleController::class,'assign']);
	Route::any('/role/roleadd',[Admin\RoleController::class,'roleadd']);

	//专业分类与专业的管理
	Route::get('/protype/showlist',[Admin\ProtypeController::class,'showlist']);
	Route::match(['get', 'post'],'/protype/addprotype',[Admin\ProtypeController::class,'addprotype']);
	Route::get('/profession/showlist',[Admin\ProfessionController::class,'showlist']);

	//课程与点播课程的管理
	Route::get('/course/showlist',[Admin\CourseController::class,'showlist']);
	Route::match(['get', 'post'],'/course/courseadd',[Admin\CourseController::class,'courseadd'])->name('courseadd');
	Route::get('/course/admgetprotyid',[Admin\CourseController::class,'getProtyId']);
	Route::post('/course/uploader/uploadpic',[Admin\UploaderController::class,'uploadpic']) -> name('uploadpic');  //图片上传
	Route::get('/lesson/showlist',[Admin\LessonController::class,'showlist']);
	Route::get('/lesson/playles',[Admin\LessonController::class,'playles']);  //播放页面
	Route::match(['get', 'post'],'/lesson/lessonadd',[Admin\LessonController::class,'lessonadd']);
	Route::get('/lesson/admgetprotyid',[Admin\LessonController::class,'getProtyId'])->name('admgetProtyId');
	Route::get('/lesson/admgetprofession_id',[Admin\LessonController::class,'getProfeId'])->name('admgetPropeId');
	Route::post('/lesson/uploader/uploadvid',[Admin\UploaderController::class,'uploadvid']) -> name('uploadvid');  //视频上传测试
	Route::get('/coursearrage/showlist',[Admin\CoursearrController::class,'showlist']);  //课程安排 
	Route::match(['get', 'post'],'/coursearrage/coursearradd',[Admin\CoursearrController::class,'coursearradd']);  //添加课程安排
	Route::get('/coursearrage/arrgetprotyid',[Admin\LiveController::class,'getprotyid']);
	Route::get('/coursearrage/arrgetfessid',[Admin\LiveController::class,'getprofeid']);


	//试卷试题管理
	Route::post('uploader/webuploader',[Admin\UploaderController::class,'webuploader']); //异步上传
   Route::get('/uploader/qiniu',[Admin\UploaderController::class,'qiniuUpload']);  //七牛上传模块
   
	Route::get('/testpaper/showlist',[Admin\TestpaperController::class,'showlist']);
	Route::match(['get', 'post'],'/testpaper/addtest',[Admin\TestpaperController::class,'addtest']);  //试卷管理
 
	Route::get('/exerpaper/showlist',[Admin\ExerpaperController::class,'showlist']);
	Route::get('/exerpaper/export',[Admin\ExerpaperController::class,'export']) -> name('exerexport');  //导出
	Route::any('/exerpaper/import',[Admin\ExerpaperController::class,'import']) -> name('exerimport');  //导入
	Route::match(['get', 'post'],'/releasepaper/showlist',[Admin\ReleasepaperController::class,'showlist']) -> name('releasepaper');  //发布试卷列表
	Route::match(['get', 'post'],'/releasepaper/releasedeal',[Admin\ReleasepaperController::class,'releasedeal']) -> name('releasedeal');  //发布试卷处理
	Route::match(['get', 'post'],'/releasepaper/answeranalysis/{id}',[Admin\ReleasepaperController::class,'answeranalysis']) -> name('answeranalysis');  //查看作答
	Route::any('/releasepaper/makethexer/{id}',[Admin\ReleasepaperController::class,'makethexer']) -> name('mkthexer'); 
	/*Route::post('/releasepaper/checkque',[Admin\ReleasepaperController::class,'checkque']) -> name('checkque');*/

	//直播管理
	Route::get('stream/showlist',[Admin\StreamController::class,'showlist']); 
	Route::any('stream/addstr',[Admin\StreamController::class,'addstr']);
	Route::match(['get', 'post'],'live/showlist',[Admin\LiveController::class,'showlist']);
	Route::match(['get', 'post'],'live/addlive',[Admin\LiveController::class,'addlive']);
	Route::get('/live/admgetprotyid',[Admin\LiveController::class,'getprotyid']);
	Route::get('/live/admgetfessid',[Admin\LiveController::class,'getprofeid']);
	Route::post('live/fabulive',[Admin\LiveController::class,'fabulive']);

	//学生管理
	Route::get('/students/showlist',[Admin\StudentsController::class,'showlist']);
	Route::any('/students/add_stu',[Admin\StudentsController::class,'add_stu']);
	Route::post('students/del_stu/{id}',[Admin\StudentsController::class,'del_stu']);

	//答疑管理
	Route::any('/dayi/showlist',[Admin\DayiController::class,'showlist'])->name('dayishowlist');
	Route::post('/dayi/dayi_add',[Admin\DayiController::class,'dayi_add'])->name('addtheque');
	Route::post('/dayi/writeanw',[Admin\DayiController::class,'writeanw'])->name('addtheanw');

});



// ------------------------------------------------------- //
   ###################    分隔线    ################
// ------------------------------------------------------- //



//前台登录部分
Route::group(['name' => 'students.'],function(){
	//登录
   Route::get('/', function(){return view('welcome');})->name('stulogin');
   //登录验证
   Route::post('/checked',[Students\StuloginController::class,'checked'])->name('logincheck');
   Route::get('/logout',[Students\StuloginController::class,'logout'])->name('logout');
});

//前台路由部分
Route::group(['name' => 'students.','middleware' => 'auth:students'],function(){

   //首页
   Route::any('/shouye',[Students\ShouyeController::class,'shouye'])->name('shoupage');
   Route::post('/checkpas',[Students\ShouyeController::class,'checkpas'])->name('checkpas');
   Route::match(['get', 'post'],'/zhognbufujia/{id}',[Students\ShouyeController::class,'zhognbufujia'])->name('zhognbufujia');

   //课程安排
   Route::any('/courhave',[Students\CourarrController::class,'courhave'])->name('courhave');  //已有课程
   Route::any('/selcourse',[Students\CourarrController::class,'selcourse'])->name('selcourse');
   Route::get('/getprotyid',[Students\CourarrController::class,'getProtyId'])->name('getProtyId');

   //课程答疑
   Route::any('/coursedayi',[Students\CoursedayiController::class,'coursedayi'])->name('coursedayi');
   Route::post('/coursedayi_add',[Students\CoursedayiController::class,'dayi_add'])->name('addcourseque');
	Route::post('/coursewriteanw',[Students\CoursedayiController::class,'writeanw'])->name('addcourseanw');

	//考试练习
	Route::any('/exerpaperlist',[Students\ExerpaperController::class,'exerpaperlist']) -> name('exerpaperlist');  //发布试卷管理
	Route::any('/exepaperstu/{paperid}',[Students\ExerpaperController::class,'exepaperstu']) -> name('exepaperstu'); 

	//视频录播
	Route::any('/videolubo',[Students\LuboController::class,'videolubo'])->name('videolubo');

	//课程直播
	Route::any('/coursezhibo',[Students\ZhiboController::class,'zhibo'])->name('courzhibo');

});

?>