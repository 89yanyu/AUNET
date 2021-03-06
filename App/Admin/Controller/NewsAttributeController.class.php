<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/2/14
 * Time: 16:25
 */

namespace Admin\Controller;
/*
* 新闻标签
*/
/*
 * create table aunet_attr(id int unsigned not null primary key auto_increme
 * nt,name char(10) not null default '',color char(10) not null default '')ENGINE=M
 * yISAM default charset=utf8;
 */
class NewsAttributeController extends CommonController{
    public function attr_index(){
        $this->attr=M('attr')->select();
        $this->display();
    }
    public function addattr(){
        $this->display();
    }
    //添加 OR 编辑属性
    public function runAddAttr(){
//        dump($_POST);die;
        if(!IS_POST){
            $this->error('页面不存在',U('attr_index'));
        }
        $attr=M('attr');
        if(I('id',0,'intval')){
            if($attr->save($_POST)){
                $this->success('修改成功',U('attr_index'));
            }else{
                $this->error('修改失败');
            }
        }else{
            if($attr->add($_POST)){
                $this->success('添加成功',U('attr_index'));
            }else{
                $this->error('添加失败');
            }
        }
    }


    public function editAttr(){
        $id=I('id',0,'intval');
//        dump($id);die;
        $this->attr=M('attr')->where(array('id'=>$id))->find();
        $this->display('addattr');
    }
    //删除属性
    public function deleteAttr(){
        $id=I('id',0,'intval');
        if(M('attr')->delete($id)){
            $this->success('删除成功',U('attr_index'));
        }else{
            $this->error('删除失败');
        }
    }

} 