<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function initialize()
    {
        if (session('?admin.id')){
            $this->redirect('admin/home/index');
        }
    }
    //后台登录
    public function login()
    {
        if (request()->isAjax()){
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password')
            ];
            $result = model('Admin')->login($data);
            if ($result == 1) {
                $this->success('登录成功','admin/home/index');
            } else {
                $this->error($result);
            }
        }
        return view();
    }

    //注册
    public function register()
    {
        if (request()->isAjax()){
            $data = [
                'username' => input('username'),
                'password' => input('password'),
                'conpass' => input('conpass'),
                'nickname' => input('nickname'),
                'email' => input('email')
            ];
            $result = model('Admin')->register($data);
            if ($result == 1){
                $this->success('注册成功','admin/index/login');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //忘记密码
    public function forget()
    {
        if (request()->isAjax()){
            $email = input('email');
            $code = mt_rand(1000,9999);
            session('code',$code);
            $result = mailto($email,'找回密码验证码','您的验证码为:'.$code);
            if ($result) {
                $this -> success('验证码发送成功');
            }else{
                $this->error('验证码发送失败');
            }
        }
        return view();
    }

    //重置密码
    public function reset()
    {
        $data = [
            'code' => input('code'),
            'email' => input('email')
        ];
        $result = model('Admin')->reset($data);
        if ($result == 1){
            $this->success('密码重置成功,请去邮箱查看新密码','admin/index/login');
        }else{
            $this->error($result);
        }
    }
}
