<?php
namespace Admin\Controller;
class AppController extends CommonController {
    public function jiguang(){
        $this->assign('bj',array(
		   'xp' => 'cmp',
		   'tb' => 'jg',
            'str' => 'APP管理',
            'url' => '/admin/App/jiguang'
		));
	    $this->display();
    }
    public function youmeng(){
        $this->assign('bj',array(
            'xp' => 'cmp',
            'tb' => 'ym',
            'str' => 'APP管理',
            'url' => '/admin/App/youmeg'
        ));
        $this->display();
    }

}