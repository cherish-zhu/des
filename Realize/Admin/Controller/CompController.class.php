<?php
namespace Admin\Controller;
class CompController extends CommonController {
    public function index(){
		$this->assign('menus',array('A'=>'扩展','B'=>'插件管理'));
	    $this->display();
    }
    
    public function myComp(){
    	$this->assign('bj',array(
		   'xp' => 'cmp',
		   'tb' => 'cmp',
    	   'str' => '我的插件',
           'url' => '/admin/mycomp'
		));
    }
    
}