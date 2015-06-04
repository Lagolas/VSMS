<?php
namespace Agentms\Controller;
use Agentms\Controller\IniController;
class IndexController extends IniController {
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->display(":index");
    }
    public function agentList(){
        $this->display(":agentlist");
    }
    public function addAgent(){
        $this->display(":addagent");
    }
}