<?php

namespace app\admin\controller;


class Cate extends Base
{
    //栏目列表
    public function catelist()
    {
        $cates = model('Cate')->order('sort','asc')->paginate(10);
        //定义一个模版数据变量
        $viewData = [
            'cates' => $cates
        ];
        $this->assign($viewData);
        return view();
    }

    //栏目添加
    public function add()
    {
        if (request()->isAjax()){
            $data = [
                'catename' => input('catename'),
                'sort' => input('sort')
            ];
            $result = model('Cate')->add($data);
            if($result == 1){
                $this->success('栏目添加成功','admin/cate/catelist');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //排序
    public function sort()
    {
        $data = [
            'id' => input('id'),
            'sort' => input('sort'),
        ];
        $result = model('Cate')->sort($data);
        if($result==1){
            $this->success('排序成功','admin/cate/catelist');
        }else{
            $this->error($result);
        }
    }

    //编辑
    public function edit()
    {
        if(request()->isAjax()){
            $data = [
                'id' => input('id'),
                'catename' => input('catename')
            ];
            $result = model('Cate')->edit($data);
            if($result == 1){
                $this->success('栏目编辑成功','admin/cate/list');
            }else{
                $this->error($result);
            }
        }
        $cateInfo = model('Cate')->find(input('id'));

        $viewData = [
            'cateInfo' => $cateInfo
        ];
        $this->assign($viewData);
        return view();
    }

    //删除
    public function delete()
    {
        $cateInfo = model('Cate')->with('article,article.comment')->find(input('id'));
        foreach ($cateInfo['article'] as $key=>$value){
            $value->together('comment')->delete();
        }
        $result = $cateInfo->together('article')->delete();
        if($result){
            $this->success('栏目删除成功','admin/cate/list');
        }else{
            $this->error('栏目删除失败');
        }
    }
}
