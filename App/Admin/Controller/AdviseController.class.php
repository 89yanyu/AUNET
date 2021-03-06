<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/2/28
 * Time: 15:26
 */
/**create table aunet_advise (id int primary key auto_increment,name varchar(30),phone varchar(15),qq varchar(9),
 * title varchar(15) not null default '',content text,feedback tinyint(1) not null default 0,
 * time timestamp not null default CURRENT_TIMESTAMP)ENGINE=MyISAM,default charset=utf8;
 *
 */
namespace Admin\Controller;
use Think\Page;

class AdviseController extends CommonController{
    public function advise_index(){
        $Advise=M('advise');
        $this->advise=$Advise->select();
        $count=$Advise->count();
        $this->count=$count;
        $Page=new Page($count,5);
        $this->advise=$Advise->order('time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->page=$Page->show();
        $this->display();
    }
    public function deladvise(){
        $id=I('id',0,'intval');
//        dump($id);
        if(M('advise')->delete($id)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }


}