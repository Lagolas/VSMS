<?php
/*
 * 全局初始化控制器（模块初始化控制器继承该控制器）
 */
namespace Common\Controller;
use Think\Controller;
class GlobaliniController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->init();
    }
    protected function init(){
        define('SOURCE_PATH', COMMON_PATH.'View/statics/');//静态资源目录
        define('PUBLIC_PATH', "/Public/");
        define('UPLOAD_ROOT_PATH','./Public/');
    }
}