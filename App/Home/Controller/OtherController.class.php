<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/4/25
 * Time: 16:17
 */

namespace Home\Controller;


use Think\Controller;

class OtherController extends Controller{
    public function advice(){
        $this->display();
    }
    public function contact(){
        $this->display();
    }
    public function member(){
        $this->display();
    }
    public function advise_handle(){
        $data=array();
        $data['name']=I('info_name');
        $data['content']=I('text');
        $data['phone']=I('info_phone');
        $data['qq']=I('info_qq');
        $data['feedback']=I('ReceiveFeedback',0,'intval');
        $data['title']=I('subject');
        if(M('advise')->add($data)){
            $this->success('您的建议已经被接受');
        }else{
            $this->error('提交错误');
        }

    }

}