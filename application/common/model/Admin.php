<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    //软删除
    use SoftDelete;

    protected $readonly = ['email'];

    //登录校验
    public function login($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('login')->check($data)){
            return $validate->getError();
        }
        $result = $this->where($data)->find();
        if ($result){
            if ($result['status'] != 1){
                return '此账户被禁用!';
            }
            //1表示有这个用户,也就是用户名和密码正确了
            $sessionData = [
                'id' => $result['id'],
                'nickname' => $result['nickname'],
                'is_super' => $result['is_super']
            ];
            session('admin',$sessionData);
            return 1;
        } else {
            return '用户名密码错误';
        }
    }

    //注册
    public function register($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('register')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            mailto($data['email'],'注册管理员成功','注册管理员成功');
            return 1;
        } else{
            return '注册失败';
        }
    }

    //充值密码
    public function reset($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('reset')->check($data)){
            return $validate->getError();
        }
        if ($data['code'] != session('code')){
            return "验证码不正确！";
        }
        $adminInfo = $this->where('email',$data['email'])->find();
        $password = mt_rand(10000,99999);
        $adminInfo->password = $password;
        $result = $adminInfo->save();
        if ($result){
            mailto($data['email'],'密码重置成功','恭喜您，密码重置成功，这是您的新密码：'.$password);
            return 1;
        }else{
            return '重置密码失败';
        }
    }

    //添加管理员
    public function add($data)
    {
        $validate = new \app\common\validate\Admin();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '添加管理员失败';
        }
    }

    //编辑管理员
    public function edit($data)
    {
        $validate = new \app\common\validate\Admin();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $adminInfo = $this->find($data['id']);
        if($data['oldpass'] != $adminInfo->password){
            return "密码不一致";
        }
        $adminInfo->password = $data['newpass'];
        $adminInfo->nickname = $data['nickname'];
        $result = $adminInfo->save();
        if($result){
            return 1;
        }else{
            return '修改管理员失败';
        }
    }
}
