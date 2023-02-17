<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//引入需要的门面
use Route;
use Auth;

class CheckRbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('admin') -> user()->role_id != '1'){
            //RBAC鉴权   rbac核心思想
            /*鉴权方法：
              思路：路由 = action =权限
              只要获取当前其访问的路由，去其角色表中找到拥有的权限，然后对比，如果路由在选取的ac中，则有权限，允许继续访问，否则没有权限，不让访问。

              注意特殊用户 超级管理员
            */

            //获取当前路由 ： App\Http\Controllers\Admin\IndexController@index
            $route = Route::currentRouteAction();
            //获取当前用户对应的角色已经具备的权限
            $ac = Auth::guard('admin') -> user() -> role -> auth_ac;
            //dd($ac.',indexcontroller@index,indexcontroller@welcome');
            $ac = strtolower($ac.',indexcontroller@index,indexcontroller@welcome');
            //判断权限
            $routeArr = explode('\\', $route);  //转化成数组
            //echo strtolower(end($routeArr));die;
            if(strpos($ac,strtolower(end($routeArr))) === false){
                exit("<h1>访问权限不足!</h>");
            }
        }
        
        //中间件不需要区分目录
        return $next($request);
    }
}
