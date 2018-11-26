<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Article extends Model
{
    //软删除
    use SoftDelete;

    //关联栏目表
    public function cate()
    {
        return $this->belongsTo('Cate','cate_id','id');
    }

    //关联评论
    public function comment()
    {
        return $this->hasMany('Comment','article_id','id');
    }

    //关联作者
    public function admin(){
        return $this->belongsTo('admin','admin_id','id');
    }

    //添加文章
    public function add($data)
    {
        $validate = new \app\common\validate\Article();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        }else {
            return '文章发布失败！';
        }
    }

    //推荐文章
    public function top($data)
    {
        $validate = new \app\common\validate\Article();
        if (!$validate->scene('top')->check($data)){
            return $validate->getError();
        }
        $articleInfo = $this->find($data['id']);
        $articleInfo->is_top = $data['is_top'];
        $result = $articleInfo->save();
        if($result){
            return 1;
        }else{
            return '操作失败';
        }
    }

    //修改文章
    public function edit($data)
    {
        $validate = new \app\common\validate\Article();
        if (!$validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $articleInfo = $this->find($data['id']);
        $result = $articleInfo->allowField(true)->save($data);
        if ($result) {
            return 1;
        }else {
            return '文章修改失败！';
        }
    }
}
