<?php

namespace app\admin\controller;


class Article extends Base
{
    //文章列表
    public function articlelist()
    {
        $articles = model('Article')->with('cate')->order(['is_top'=>'desc','create_time'=>'desc'])->paginate('10');
        $viewData = [
            'articles' => $articles
        ];
        $this->assign($viewData);
        return view();
    }

    //文章添加
    public function add()
    {
        if (request()->isAjax()) {
            $data = [
                'title' => input('title'),
                'is_top' => input('is_top'),
                'tags' => input('tags',0),
                'cate_id' => input('cate_id'),
                'desc' => input('desc'),
                'content' => input('content'),
            ];
            $result = model('Article')->add($data);
            if ($result == 1) {
                $this->success('文章发布成功！', 'admin/article/articlelist');
            }else {
                $this->error($result);
            }
        }
        $cates = model('Cate')->select();
        $viewData = [
            'cates' => $cates
        ];
        $this->assign($viewData);
        return view();
    }

    //推荐操作
    public function top()
    {
        $data = [
            'id' => input('id'),
            'is_top' => input('is_top')==1?0:1,
        ];
        $result = model('Article')->top($data);
        if($result==1){
            $this->success('推荐成功','admin/article/articlelist');
        }else{
            $this->error($result);
        }
    }

    //编辑操作
    public function edit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('id'),
                'title' => input('title'),
                'is_top' => input('is_top')?1:0,
                'tags' => input('tags',0),
                'cate_id' => input('cate_id'),
                'desc' => input('desc'),
                'content' => input('content'),
            ];
            $result = model('Article')->edit($data);
            if ($result == 1) {
                $this->success('文章修改成功！', 'admin/article/articlelist');
            }else {
                $this->error($result);
            }
        }
        $articleInfo = model('Article')->find(input('id'));
        $cates = model('Cate')->select();
        $viewData = [
            'articleInfo' => $articleInfo,
            'cates' => $cates,
        ];
        $this->assign($viewData);
        return view();
    }

    //删除
    public function delete()
    {
        $articleInfo = model('Article')->with('comment')->find(input('id'));
        $result = $articleInfo->together('comment')->delete();
        if($result){
            $this->success('删除文章成功','admin/article/articlelist');
        }else{
            $this->error('删除文章失败');
        }
    }
}
