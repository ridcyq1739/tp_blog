<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class System extends Model
{
    //软删除
    use SoftDelete;

    //设置系统
    public function set($data)
    {
        $validate = new \app\common\validate\System();
        if(!$validate->check($data)){
            return $validate->getError();
        }
        $webInfo = $this->find($data['id']);
        $result = $webInfo->allowField('true')->save($data);
        if($result){
            return 1;
        }else{
            return "系统设置失败";
        }
    }
}
