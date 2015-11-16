<?php
namespace Admin\Controller;
class gameController extends CommonController {
	public function index(){
		$this->assign('menus',array('A'=>'扩展','B'=>'游戏管理'));
		$this->display();
	}
    
	public function myGame(){
		$this->assign('bj',array(
		   'xp' => 'cmp',
		   'tb' => 'game',
		   'str' => '游戏中心',
		   'url' => '/admin/Gage/myGame'
		));
		$this->display();
	}
}