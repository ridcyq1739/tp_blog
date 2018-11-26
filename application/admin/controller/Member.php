<?php

namespace app\admin\controller;

use think\Controller;

class Member extends Base
{
    //会员列表
    public function memberlist()
    {
        $members = model('Member')->order('create_time','desc')->paginate(10);
        $viewData = [
            'members' => $members,
        ];
        $this->assign($viewData);
        return view();
    }

    //会员添加
    public function add()
    {
        if(request()->isAjax()){
            $data = [
                'username' => input('username'),
                'password' => input('password'),
                'nickname' => input('nickname'),
                'email' => input('email')
            ];
            $result = model('Member')->add($data);
            if($result ==1){
                $this->success('会员添加成功','admin/member/memberlist');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //会员编辑
    public function edit()
    {
        if(request()->isAjax()){
            $data = [
                'id' => input('id'),
                'oldpass' => input('oldpass'),
                'newpass' => input('newpass'),
                'nickname' => input('nickname')
            ];
            $result = model('Member')->edit($data);
            if($result ==1){
                $this->success('会员修改成功','admin/member/memberlist');
            }else{
                $this->error($result);
            }
        }
        $memberInfo = model('Member')->find(input('id'));
        $viewData = [
            'memberInfo' => $memberInfo,
        ];
        $this->assign($viewData);
        return view();
    }

    //会员删除
    public function delete()
    {
        $memberInfo = model('Member')->with('comment')->find(input('id'));
        $result = $memberInfo->together('comment')->delete();
        if ($result){
            $this->success('删除成功','admin/member/memberlist');
        }else{
            $this->error('删除会员失败');
        }
    }
}
