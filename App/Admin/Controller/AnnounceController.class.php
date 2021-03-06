<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/4/25
 * Time: 13:29
 */

namespace Admin\Controller;


use Think\Page;

class AnnounceController extends CommonController{
    public function announce_index(){
        $Announce=M('announce');
        $count=$Announce->count();
        $Page=new Page($count,5);
        $this->count=$count;
        $this->data=$Announce->order('time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->page=$Page->show();
        $this->display();
    }
    public function add_announce(){

        $this->display();
    }
    public function add_announce_handle(){
        $title=I('title');
        $id=$_SESSION['uid'];
        $date=time();
        $data=array('uid'=>$id,'title'=>$title,'time'=>$date);
        if(M('announce')->add($data)){
            $this->success('添加成功','announce_index');
        }else{
            $this->error('添加失败');
        }
//        dump($id);
    }
    public function DelAnnounce(){
        $id=I('id',0,'intval');
        if(M('announce')->delete($id)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}