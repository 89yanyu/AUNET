<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/4/18
 * Time: 4:27
 */

namespace Home\Controller;


use Think\Controller;
use Think\Page;

class NewsController extends Controller{
    public function index(){
        $count=D('news')->count();
        $Page=new Page($count,3);

        $this->news=D('news')->where(array('del'=>0))->order('time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
//        dump($this->news);
//        die;
        $this->page=$Page->show();
        $this->count=$count;
//        dump($this->news);
        $this->display();
    }
}