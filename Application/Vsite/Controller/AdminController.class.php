<?php
namespace Vsite\Controller;
use Vsite\Controller\IniController;
class AdminController extends IniController{
    public function __construct() {
        parent::__construct();
    }
    
    protected function init() {
        parent::init();
        $this->_isAdmin();
        
    }
    
    public function index(){
        $this->display();
    }
    /**************
     * 文章管理
     **************/
    public function artList(){
        $where['model'] = 1;
        $catelist = $this->_getCategorys($where);
        $post_cid= I('post.cid','','intval');
        if($post_cid>0){
            $cid = $this->_getSubCate($post_cid, $catelist);
            $where_art['cid'] = array('in',$cid);
        }
        if(I('post.title')){
            $tit = I('post.title');
            $where_art['title'] = array('like',"%{$tit}%");
        }
        $db = M('article');
        $where_art['uid'] = $this->user['id'];
        $count = $db->where($where_art)->count();
        $Page = new \Think\Page($count);
        $artlist = $db->where($where_art)->field('id,uid,cid,title,ctime,listorder,state')->limit($Page->firstRow.','.$Page->listRows)->order('listorder DESC,id DESC')->select();
        $cid = I('get.cid')?I('get.cid','','intval'):I('post.cid','','intval');
        $title = I('get.title')?I('get.title'):I('post.title');
        $this->assign('cid',$cid);
        $this->assign('title',$title);
        $this->assign('artlist',$artlist);
        $this->assign('page',$Page->show());
        $this->assign('catelist',$catelist);
        $this->display();
    }
    
    public function editArt(){
        $where['id'] = I('get.id','','intval');
        $where['uid'] = $this->user['id'];
        $article = M('article')->where($where)->find();
        if($article){
            $where_cate['model'] = 1;
            $where_cate['state'] = 1;
            $catelist = $this->_getCategorys($where_cate);
            $this->assign('catelist',$catelist);
            $this->assign('article',$article);
            $this->display();
        }else{
            $this->error('#404# 世界这么大，怎么也找不到！');
        }
    }
    
    public function goEditArt(){
        if(!IS_POST) exit;
        //检查必填项以及长度
        $data['title'] = I('post.title');
        $data['cid'] = I('post.cid','','intval');
        if(!$data['title'] || !$data['cid'] || strlen($data['title'])>255){
            $this->error('文章标题或栏目不合法');
        }
        $checkmodel['id'] = $data['cid'];
        $checkmodel['uid'] = $this->user['id'];
        $model = M('categorys')->where($checkmodel)->getField('model');
        if(intval($model)!==1){$this->error('栏目选择错误');}
        $data['keyword'] = I('post.keyword');
        $data['description'] = I('post.description');
        $data['etime'] = NOW_TIME;
        $data['content'] = $_POST['editorValue'];
        $data['listorder'] = I('post.listorder','','intval');
        if($_FILES['thumb']['name']){
            $info = $this->_upload();
            if($info['state']){
                $data['thumb'] = UPLOAD_ROOT_PATH.$info['info']['thumb']['savepath'].$info['info']['thumb']['savename'];
            }else{
                $this->error($info['info']);
            }
        }
        $data['uid'] = $this->user['id'];
        $where['id'] = I('post.id','','intval');
        $where['uid'] = $this->user['id'];
        if(M('article')->where($where)->save($data)){
            $this->success('文章修改成功');
        }else{
            $this->error("修改失败");
        }
    }

    public function delArt(){
        $where['id'] = I('get.id','','intval');
        $where['uid'] = $this->user['id'];
        if(M('article')->where($where)->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    public function addArticle(){
        $where['model'] = 1;
        $where['state'] = 1;
        $info=$this->_getCategorys($where);
        $this->assign('catelist',$info);
        $this->display();
    }
    
    public function goAddArticle(){
        if(!IS_POST) exit;
        //检查必填项以及长度
        $data['title'] = I('post.title');
        $data['cid'] = I('post.cid','','intval');
        if(!$data['title'] || !$data['cid'] || strlen($data['title'])>255){
            $this->error('文章标题或栏目不合法');
        }
        $checkmodel['id'] = $data['cid'];
        $checkmodel['uid'] = $this->user['id'];
        $model = M('categorys')->where($checkmodel)->getField('model');
        if(intval($model)!==1){$this->error('栏目选择错误');}
        $data['keyword'] = I('post.keyword');
        $data['description'] = I('post.description');
        $data['etime'] = $data['ctime'] = NOW_TIME;
        $data['content'] = $_POST['editorValue'];
        $data['listorder'] = I('post.listorder','','intval');
        if($_FILES['thumb']['name']){
            $info = $this->_upload();
            if($info['state']){
                $data['thumb'] = UPLOAD_ROOT_PATH.$info['info']['thumb']['savepath'].$info['info']['thumb']['savename'];
            }else{
                $this->error($info['info']);
            }
        }
        $data['uid'] = $this->user['id'];
        if(M('article')->add($data)){
            $this->success('文章发布成功');
        }else{
            $this->error("发布失败");
        }
    }
    
    /*************
     * 图集管理
     *************/
    public function picList(){
        $where['model'] = 2;
        $catelist = $this->_getCategorys($where);
        $post_cid= I('post.cid','','intval');
        if($post_cid>0){
            $cid = $this->_getSubCate($post_cid, $catelist);
            $where_art['cid'] = array('in',$cid);
        }
        if(I('post.title')){
            $tit = I('post.title');
            $where_art['title'] = array('like',"%{$tit}%");
        }
        $db = M('picgroup');
        $where_art['uid'] = $this->user['id'];
        $count = $db->where($where_art)->count();
        $Page = new \Think\Page($count);
        $piclist = $db->where($where_art)->field('id,uid,cid,title,ctime,listorder,state')->limit($Page->firstRow.','.$Page->listRows)->order('listorder DESC,id DESC')->select();
        $cid = I('get.cid')?I('get.cid','','intval'):I('post.cid','','intval');
        $title = I('get.title')?I('get.title'):I('post.title');
        $this->assign('cid',$cid);
        $this->assign('title',$title);
        $this->assign('piclist',$piclist);
        $this->assign('page',$Page->show());
        $this->assign('catelist',$catelist);
        $this->display();
    }

    public function addPic(){
        $where['model'] = 2;
        $where['state'] = 1;
        $catelist = $this->_getCategorys($where);
        $this->assign('catelist',$catelist);
        $this->display();
    }
    
    public function editPicGroup(){
        
    }
    
    public function delPicGroup(){
        $where['id'] = I('get.id','','intval');
        $where['uid'] = $this->user['id'];
        if(M('picgroup')->where($where)->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    public function goAddPic(){
      unset($_FILES['files']);
      if(!IS_POST) exit;
        //检查必填项以及长度
        $data['title'] = I('post.title');
        $data['cid'] = I('post.cid','','intval');
        if(!$data['title'] || !$data['cid'] || strlen($data['title'])>255){
            $this->error('文章标题或栏目不合法');
        }
        $checkmodel['id'] = $data['cid'];
        $checkmodel['uid'] = $this->user['id'];
        $model = M('categorys')->where($checkmodel)->getField('model');
        if(intval($model)!==2){$this->error('栏目选择错误');}
        $data['keyword'] = I('post.keyword');
        $data['description'] = I('post.description');
        $data['etime'] = $data['ctime'] = NOW_TIME;
        $data['content'] = $_POST['editorValue'];
        $data['listorder'] = I('post.listorder','','intval');
        $data['pics'] = serialize(I('post.picgroup'));
        if($_FILES['thumb']['name']){
            $info = $this->_upload();
            if($info['state']){
                $data['thumb'] = UPLOAD_ROOT_PATH.$info['info']['thumb']['savepath'].$info['info']['thumb']['savename'];
            }else{
                $this->error($info['info']);
            }
        }
        $data['uid'] = $this->user['id'];
        if(M('picgroup')->add($data)){
            $this->success('图集发布成功');
        }else{
            $this->error("发布失败");
        }
    }
    /*************
     * 栏目管理
     *************/
    public function cate(){
        $tpl = I('get.op');
        if(!in_array($tpl,array('addCate','cateList'))) $this->error ('参数错误');
        
        if(I('get.model')){
            $where['model'] = I('get.model','','intval');//1代表文章模型 2代表图集  3代表商品模型
        }
        $info=$this->_getCategorys($where);
        $this->assign('all_cate',$info);
        $this->display($tpl);
    }
    public function goAddCate(){
        if(IS_POST){
            if(!I('post.cate_name')) $this->error ('栏目名称不能为空');
            if(!I('post.model','','intval')) $this->error ('请选择所属模型');
            if(I('post.pid','','intval')>0){
                $where_pid['id'] = I('post.pid','','intval');
                $pid_model = M('categorys')->where($where_pid)->getField('model');
                if($pid_model!=I('post.model','','intval')) $this->error ('参数错误');
            }
            $model = "categorys";
            $where['cate_name'] =I('post.cate_name');
            $where['uid'] = $this->user['id'];
            $where['model'] = I('post.model','','intval');
            if($this->_notUnique($model,$where)){
                $this->error('栏目名称已存在');
            }
            $_POST['path']=$this->_getPath(I('post.pid','','intval'));
            $_POST['uid'] = $this->user['id'];
            $_POST['ctime'] = NOW_TIME;
            if(M('categorys')->add($_POST)){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }
    }
    /************
     * 异步请求
     ************/
    //多图上传
    public function aj_picGroupUpload(){
        Vendor('JqueryFileUpload.UploadHandler');
        $upload_handler = new \UploadHandler();
    }
    /***********
     * 私有方法
     ***********/
    //无限级栏目分类组合path
    private function _getPath($pid){
        $db = M('categorys');
        $data=$db->where("id={$pid}")->find();//查询父栏目的path
        if($data){
            $path=$data['path']."-".$data['id'];//将父栏目的path和id用“-”连接组合成新栏目的path
        }else{
            $path = "";
        }
        return $path;//将新栏目的path数据return出去
    }
    //验证是否字段值唯一
    private function _notUnique($model,$where){
        $db = M($model);
        $result = $db->where($where)->find();
        if($result){
            return true;
        }else{
            return false;
        }
    }
    //判断是否是管理员
    private function _isAdmin(){
        if(empty($this->user) || $this->user['level'] <= 0) $this->error('权限不足，禁止访问',U('adminuser/login'));
    }
    //查询栏目
    private function _getCategorys($where){
        $where['uid'] = $this->user['id'];
        $info=M('categorys')->field("id,cate_name,model,path,concat(path,'-',id) as newpath")->order('newpath')->where($where)->select();
        foreach($info as $key=>$val){
            $result[$val['id']] = $val;
            $result[$val['id']]['num'] = 6*substr_count($info[$key]['path'],'-');
            //$info[$key]['num']=6*substr_count($info[$key]['path'],'-');
        }
        return $result;
    }
    // 文件上传
    private function _upload($dir) {
       $dir = $dir?$dir:"";
       $config = array(
            'maxSize'    =>    3145728,
            'rootPath'   =>    UPLOAD_ROOT_PATH,
            'savePath'   =>    'Upload/'.$dir."/",
            'saveName'   =>    array('uniqid',''),
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub'    =>    true,
            'subName'    =>    array('date','Ymd'),
        );

       $upload = new \Think\Upload($config);// 实例化上传类
       $info = $upload->upload();
       if(!$info) {// 上传错误提示错误信息
           $return['state'] = 0;
           $return['info'] = $upload->getError();
       }else{// 上传成功
           $return['state'] = 1;
           $return['info'] = $info;
       }
       return $return;
    }
    
    private function _getSubCate($post_cid,$catelist){
        $cid[] = $post_cid;
        foreach($catelist as $v){
            $path = explode('-',$v['path']);
            if(in_array($post_cid,$path)){
                $cid[] = $v['id'];
            }
        }
        return $cid;
    }
}