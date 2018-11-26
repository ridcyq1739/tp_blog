<?php

namespace app\admin\controller;

use think\Controller;

class System extends Controller
{
    //系统设置
    public function set()
    {
        if(request()->isAjax()){
            $data = [
                'id' =>  input('id'),
                'webname' => input('webname'),
                'copyright' => input('copyright')
            ];
            $result = model('System')->set($data);
            if($result == 1){
                $this->success('设置成功','admin/home/index');
            }else{
                $this->error('设置失败');
            }
        }
        $webInfo = model('System')->find();
        $viewData = [
            'webInfo' => $webInfo,
        ];
        $this->assign($viewData);
        return view();
    }
}
