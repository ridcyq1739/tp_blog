<?php

namespace app\admin\controller;

use think\Controller;

class Admin extends Base
{
    //管理员列表
    public function adminlist()
    {
        $admins = model('Admin')->order(['is_super'=>'asc','status'=>'asc'])->paginate(10);
        $viewData = [
            'admins' => $admins,
        ];
        $this->assign($viewData);
        return view();
    }

    //管理员添加
    public function add()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('username'),
                'password' => input('password'),
                'conpass' => input('conpass'),
                'nickname' => input('nickname'),
                'email' => input('email')
            ];
            $result = model('Admin')->add($data);
            if ($result == 1) {
                $this->success('账户添加成功！', 'admin/admin/adminlist');
            }else {
                $this->error($result);
            }
        }
        return view();
    }

    //管理员状态操作
    public function status()
    {
        $data = [
            'id' => input('id'),
            'status' => input('status')==1?0:1,
        ];
        $adminInfo = model('Admin')->find($data['id']);
        $adminInfo->status = $data['status'];
        $result = $adminInfo->save();
        if($result){
            $this->success('操作成功','admin/admin/adminlist');
        }else{
            $this->error('操作失败');
        }
    }

    //管理员编辑
    public function edit()
    {
        if(request()->isAjax()){
            $data = [
                'id' => input('id'),
                'oldpass' => input('oldpass'),
                'newpass' => input('newpass'),
                'nickname' => input('nickname')
            ];
            $result = model('Admin')->edit($data);
            if($result==1){
                $this->success('修改管理员成功','admin/admin/adminlist');
            }else{
                $this->error($result);
            }
        }
        $adminInfo = model('Admin')->find(input('id'));
        $viewData = [
            'adminInfo' => $adminInfo
        ];
        $this->assign($viewData);
        return view();
    }

    //管理员删除
    public function delete()
    {
        $adminInfo = model('Admin')->find(input('id'));
        $result = $adminInfo->delete();
        if($result){
            $this->success('删除成功','admin/admin/adminlist');
        }else{
            $this->error('删除失败');
        }
    }
}
