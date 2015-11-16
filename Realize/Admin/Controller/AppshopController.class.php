<?php
namespace Admin\Controller;
class AppshopController extends CommonController {
    public function index(){
        $this->assign('bj',array(
		   'xp' => 'app',
		   'tb' => 'app',
            'str' => '应用超市',
            'url' => '/admin/appshop'
		));
	    $this->display();
    }

}