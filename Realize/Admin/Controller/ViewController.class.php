<?php
namespace Admin\Controller;
class viewController extends CommonController {
	  
    public function index(){
		$this->assign('menus',array('A'=>'界面','B'=>'我的模板'));
    	$this->display();
    }
    
    public function shopView(){
		$this->assign('menus',array('A'=>'界面','B'=>'模板超市'));
    	$this->display();
    }
    
    public function editView(){
    	
    	if($_POST['code']){
    		
    		file_put_contents($_GET['file'], $_POST['code']);
    		
    	}

    	$views = array();
        
    	$conf = require_once('./Realize/Content/Conf/config.php');
    	
    	$code = file_get_contents($_GET['file']);

    	
    	$this->assign('views',$conf['DEFAULT_THEME']);
    	
    	$this->assign('code',$code);
    	
		$this->assign('menus',array('A'=>'界面','B'=>'模板编辑'));
    	$this->display();
    }
}