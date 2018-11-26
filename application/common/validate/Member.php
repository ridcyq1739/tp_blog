<?php
/**
 * Created by PhpStorm.
 * User: KR
 * Date: 2018/11/15
 * Time: 18:07
 */

namespace app\common\validate;


use think\Validate;

class Member extends Validate
{
    protected $rule = [
        'username|用户名' => 'require',
        'password|密码' => 'require',
        'conpass|确认密码' => 'require|confirm:password',
        'nickname|会员昵称' => 'require',
        'email|邮箱' => 'require|email|unique:member',
        'oldpass|原密码' => 'require',
        'newpass|新密码' => 'require',
        'verify|验证码' => 'require|captcha'
    ];

    //会员添加场景
    public function sceneAdd()
    {
        return $this->only(['username','password','nickname','email'])->append(['username'=>'unique:member']);
    }

    //会员编辑场景
    public function sceneEdit()
    {
        return $this->only(['oldpass','newpass','nickname']);
    }

    //会员注册场景
    public function sceneRegister()
    {
        return $this->only(['username','password','conpass','nickname','email','verify'])->append(['username'=>'unique:member']);
    }

    //会员登录场景
    public function sceneLogin()
    {
        return $this->only(['username','password','verify']);
    }
}