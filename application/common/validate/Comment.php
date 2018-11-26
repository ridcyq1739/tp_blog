<?php
/**
 * Created by PhpStorm.
 * User: KR
 * Date: 2018/11/16
 * Time: 12:02
 */

namespace app\common\validate;


use think\Validate;

class Comment extends Validate
{
    protected $rule = [
        'content|内容' => 'require'
    ];
}