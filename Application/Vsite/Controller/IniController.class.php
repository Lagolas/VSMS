<?php
namespace Vsite\Controller;
use Common\Controller\GlobaliniController;
class IniController extends GlobaliniController {
    protected $user;
    public function __construct() {
        parent::__construct();
    }
    protected function init() {
        parent::init();
        $cookie = explode('-',authcode(cookie('authcookie')));
        if($cookie[1]){
            $where['id'] = $cookie[1];
            $where['state'] = 1;
            $this->user = M('member')->where($where)->find();
        }
    }
    
}