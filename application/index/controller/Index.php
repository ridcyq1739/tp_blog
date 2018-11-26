<?php
namespace app\index\controller;

use think\Controller;

class Index extends Base
{
    public function index()
    {
        $where = [];
        $catename = null;
        if(input('id')){
            $where = ['cate_id'=>input('id')];
            $catename = model('Cate')->where('id',input('id'))->value('catename');
        }
        $articles = model('Article')->where($where)->with('Admin')->order('create_time','desc')->paginate(5);
        $viewData = [
            'articles' => $articles,
            'catename' => $catename
        ];
        $this->assign($viewData);
        return view();
    }

    public function register()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('username'),
                'email' => input('email'),
                'password' => input('password'),
                'conpass' => input('conpass'),
                'nickname' => input('nickname'),
                'verify' => input('verify')
            ];
            $result = model('Member')->register($data);
            if ($result == 1) {
                $this->success('注册成功！','index/index/login');
            }else {
                $this->error($result);
            }
        }
        return view();
    }

    public function login()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('username'),
                'password' => input('password'),
                'verify' => input('verify')
            ];
            $result = model('Member')->login($data);
            if ($result == 1) {
                $this->success('登录成功！','index/index/index');
            }else {
                $this->error($result);
            }
        }
        return view();
    }

    public function logout()
    {
        session(null);
        if(session('?index.id')){
            $this->error('退出失败');
        }else{
            $this->success('退出成功','index/index/index');
        }
    }

    public function search()
    {
        $where[] = ['title','like','%'.input('keyword').'%'];
        $catename = input('keyword');
        $articles = model('Article')->where($where)->order('create_time','desc')->paginate('5');
        $viewData = [
            'articles' => $articles,
            'catename' => $catename
        ];
        $this->assign($viewData);
        return view('index');
    }
}
