<?php
/**
 * Created by PhpStorm.
 * User: KR
 * Date: 2018/11/14
 * Time: 21:37
 */

namespace app\common\validate;


use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename|栏目名称' => 'require|unique:cate',
        'sort|排序' => 'require|number'
    ];

    public function sceneAdd()
    {
        return $this->only(['catename','sort']);
    }

    public function sceneSort()
    {
        return $this->only(['sort']);
    }

    public function sceneEdit()
    {
        return $this->only(['catename']);
    }
}