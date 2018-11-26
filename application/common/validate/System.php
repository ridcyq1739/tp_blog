<?php
/**
 * Created by PhpStorm.
 * User: KR
 * Date: 2018/11/16
 * Time: 14:25
 */

namespace app\common\validate;


use think\Validate;

class System extends Validate
{
    protected $rule = [
        'webname' => 'require',
        'copyright' => 'require'
    ];
}