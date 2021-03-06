<?php
namespace Material\Controller;
use Org\Util\Rbac;
use Think\Controller;
use Think\Verify;
class IndexController extends Controller {

    public function index(){
//        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover,{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $this->display();
    }
    public function material_login(){
        if(!check_verify(I('code',''))){
            $this->error('验证码错误');
        }
        $username=I('username');
        $user=M('user')->where(array('username'=>$username))->find();
        $pwd=I('password','','md5');
        if(!$user|$user['password']!=$pwd){
            $this->error('用户名或密码错误');
        }
        if($user['lock']){
            $this->error('用户被锁定,请联系管理员解锁');
        }
        $data=array('id'=>$user['id'],
            'logintime'=>time(),
            'loginip'=>get_client_ip()
        );
        M('user')->save($data);
        session(C('USER_AUTH_KEY'),$user['id']);
        session('username',$user['username']);
        session('lastlogintime',date('Y-m-d H:i',$user['logintime']));
        session('lastloginip',$user['loginip']);
        if($user['username']==C('RBAC_SUPERADMIN')){
            session(C('ADMIN_AUTH_KEY'),true);
        }

        import('Org.Util.Rbac');
        Rbac::saveAccessList();
//        dump($_SESSION);die;
        $this->redirect('Material/Material/material_index');

    }
    public function verify(){
        $config=array(
            'codeSet'=>'0123456789',
            'fontsize'=>20,
            'length'=>3,
        );
        $verify=new Verify($config);
        $verify->entry();
    }
}