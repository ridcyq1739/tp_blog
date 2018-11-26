<?php
/**
 * Created by PhpStorm.
 * User: KR
 * Date: 2018/11/15
 * Time: 13:05
 */

namespace app\common\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title|文章标题' => 'require|unique:article',
        'cate_id|所属栏目' => 'require',
        'tags|标签' => 'require',
        'desc|文章简要' => 'require',
        'content|文章内容' => 'require',
        'is_top|推荐' => 'require',
    ];

    //文章添加场景
    public function sceneAdd()
    {
        return $this->only(['title', 'cate_id', 'tags','desc', 'content']);
    }

    //推荐场景
    public function sceneTop()
    {
        return $this->only(['is_top']);
    }

    //文章编辑场景
    public function sceneEdit()
    {
        return $this->only(['title', 'cateid', 'tags', 'desc', 'content']);
    }
}