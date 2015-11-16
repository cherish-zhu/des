<?php
namespace Admin\Controller;
class ToolsController extends CommonController {
	public function index(){
		$this->assign('menus',array('A'=>'扩展','B'=>'工具箱'));
		$this->display();
	}
	
	public function myTools(){
		$this->assign('menus',array('A'=>'扩展','B'=>'工具箱'));
		$this->display();
	}

}