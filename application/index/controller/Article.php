<?php

namespace app\index\controller;

use function Sodium\increment;
use think\Controller;

class Article extends Base
{
    //文章详情
    public function detail()
    {
        $articleInfo = model('Article')->with('admin,comment,comment.member')->find(input('id'));
        $com_num = count($articleInfo['comment']);
        $articleInfo->setInc('views');
        $viewData = [
            'articleInfo' => $articleInfo,
            'com_num' => $com_num
        ];
        $this->assign($viewData);
        return view('article');
    }

    //文章评论
    public function comment()
    {
        $data = [
            'member_id' => input('member_id'),
            'article_id' => input('article_id'),
            'content' => input('content')
        ];
        $result = model('Comment')->com($data);
        if($result==1){
            $this->success('评论成功');
        }else{
            $this->error($result);
        }
    }
}
