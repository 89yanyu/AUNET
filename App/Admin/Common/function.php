<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/2/6
 * Time: 20:51
 */
/*
 * 递归重组节点信息为多维数组
 */
function node_merge($node,$access=null,$pid=0){
    $arr=array();
    foreach($node as $v){
        if(is_array($access)){
            if(in_array($v['id'],$access)){
                $v['access']=1;
            }else{
                $v['access']=0;
            }
        }
        if($v['pid']==$pid){
            $v['child']=node_merge($node,$access,$v['id']);
            $arr[]=$v;
        }
    }
    return $arr;
}

//递归遍历获得文件列表
//@return : 多维数组
function get_filetree_scandir($path='..'){
    $result = array();
    $temp = array();
    if (!is_dir($path)||!is_readable($path)) return null; //检测目录有效性
    $allfiles = scandir($path); //获取目录下所有文件与文件夹
    foreach ($allfiles as $filename) { //遍历一遍目录下的文件与文件夹
        if (in_array($filename,array('.','..'))) continue; //无视 . 与 ..
        $fullname = $path.'/'.$filename; //得到完整文件路径
        if (is_dir($fullname)) { //是目录的话继续递归
            $result[$filename] = get_filetree_scandir($fullname); //递归开始
        }
        else {
            $temp[] = $filename; //如果是文件，就存入数组
        }
    }
    foreach ($temp as $tmp) { //把临时数组的内容存入保存结果的数组
        $result[] = $tmp; //这样可以让文件夹排前面，文件在后面
    }
    return $result;
}

//获得目录文件列表
function get_filetree($path='..'){
    $tree = array();
    foreach(glob($path.'/*') as $single){
        if(is_dir($single)){
            $tree = array_merge($tree,get_filetree($single));
        }
        else{
            $tree[] = $single;
        }
    }
    return $tree;
}