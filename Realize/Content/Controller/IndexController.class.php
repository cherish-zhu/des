<?php
namespace Content\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        breadcrumbNavigation($_GET);
    	$this->assign('tuijian',$this->content_list(3,9));
    	$this->assign('huazhuang',$this->content_list(NULL,6,NULL,'huazhuang'));  
    	$this->assign('meifa',$this->content_list(NULL,4,NULL,'meifa'));
    	$this->assign('meijia',$this->content_list(NULL,4,NULL,'meijia'));
    	$this->assign('meizhuang',$this->content_list(NULL,4,NULL,'chuanyidaban'));
    	$this->assign('hufu',$this->content_list(NULL,4,NULL,'hufu'));
    	$this->assign('links',M('links')->select());
        $this->display();
    }
}