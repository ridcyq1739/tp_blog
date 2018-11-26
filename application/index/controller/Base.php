<?php

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    //
    public function initialize()
    {
        $cates = model('Cate')->order('sort','asc')->select();
        $webInfo = model('System')->find();
        $top_articles = model('Article')->where('is_top',1)->order('create_time','desc')->limit(10)->select();
        $viewData = [
            'cates' => $cates,
            'webInfo' => $webInfo,
            'top_articles' => $top_articles,

        ];
        $this->view->share($viewData);
    }
}
