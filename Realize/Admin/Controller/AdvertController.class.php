<?php
namespace Admin\Controller;
class advertController extends CommonController {
	public function index(){
		$this->assign('bj',array(
		   'xp'  => 'sys',
		   'tb'  => 'adv',
		   'str'  => '广告管理',
		    'url' => '/admin/advert'
		));
		$this->display();
	}
}