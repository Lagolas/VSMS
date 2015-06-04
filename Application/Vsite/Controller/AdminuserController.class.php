<?php
namespace Vsite\Controller;
use Vsite\Controller\IniController;
class AdminuserController extends IniController{
    public function __construct() {
        parent::__construct();
    }
    
    public function init() {
        parent::init();
    }
    
    public function login(){
        if(cookie('authcookie')){
            redirect(U('admin/index'));
        }
        $this->display();
    }
    
    public function gologin(){
        if(!IS_POST) exit;
        $where['name'] = I('post.name');
        $db = M('member');
        $userinfo = $db->where($where)->find();
        if($userinfo && intval($userinfo['state'])!==1) {$this->error ('禁止登陆，请联系管理员');exit;}
        $salt = $userinfo['salt'];
        $subpwd = I('post.password');
        if(MD5($subpwd."+".$salt)==$userinfo['password']){
            cookie('authcookie',  authcode($where['name'].'-'.$userinfo['id'].'-'.GetIP(),'ENCODE'));
            $this->success('登陆成功',U('admin/index'));
        }else{
            $this->error('用户名或密码错误');
        }
    }
}