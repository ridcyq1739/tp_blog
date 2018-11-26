<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::rule('cate/:id','index/index/index','get');
Route::rule('/','index/index/index','get');
Route::rule('article/:id','index/article/detail','get');
Route::rule('comment','index/article/comment','post');
Route::rule('register','index/index/register','get|post');
Route::rule('login','index/index/login','get|post');
Route::rule('logout','index/index/logout','post');
Route::rule('search','index/index/search','get');

Route::group('admin',function (){
   Route::rule('/','admin/index/login','get|post');
   Route::rule('register','admin/index/register','get|post');
   Route::rule('forget','admin/index/forget','get|post');
   Route::rule('reset','admin/index/reset','post');
   Route::rule('index','admin/home/index','get');
   Route::rule('logout','admin/home/logout','get');
   Route::rule('cate/list','admin/cate/catelist','get');
   Route::rule('cate/add','admin/cate/add','get|post');
   Route::rule('cate/sort','admin/cate/sort','post');
   Route::rule('cate/edit/[:id]','admin/cate/edit','get|post');
   Route::rule('cate/delete','admin/cate/delete','post');
   Route::rule('article/list','admin/article/articlelist','get|post');
   Route::rule('article/add','admin/article/add','get|post');
   Route::rule('article/top','admin/article/top','post');
   Route::rule('article/edit/[:id]','admin/article/edit','get|post');
   Route::rule('article/delete','admin/article/delete','post');
   Route::rule('member/list','admin/member/memberlist','get|post');
   Route::rule('member/add','admin/member/add','get|post');
   Route::rule('member/edit/[:id]','admin/member/edit','get|post');
   Route::rule('member/delete','admin/member/delete','post');
   Route::rule('admin/list','admin/admin/adminlist','get|post');
   Route::rule('admin/add','admin/admin/add','get|post');
   Route::rule('admin/status','admin/admin/status','post');
   Route::rule('admin/edit/[:id]','admin/admin/edit','get|post');
   Route::rule('admin/delete','admin/admin/delete','post');
   Route::rule('comment/list','admin/comment/all','get');
   Route::rule('comment/delete','admin/comment/delete','post');
   Route::rule('set','admin/system/set','get|post');
});
