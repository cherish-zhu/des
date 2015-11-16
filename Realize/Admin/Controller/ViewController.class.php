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
    	
    	$view = array(
    			'Content' => array(
    					'dir' => 'Content',
    					'tpl' => ''
    			),
    			'Ucenter' => array(
    					'dir' => 'Ucenter',
    					'tpl' => 'default/'
    			)
    	);
    	$views = array();
    	foreach ($view as $m => $n){
    	
    	$file = './Realize/'.$n['dir'].'/View/'.$n['tpl'];
    	$content  = scandir($file);
    	foreach ($content as $key => $val){
    		if(!is_dir($file.$val) || $val == '.' || $val == '..') continue;
    		$views[$n['dir']][$key]['dir'] = $val;
    		$content_file = scandir($file.$val);
    		
    		foreach ($content_file as $k => $v){
    			if(!is_dir($file.$val) || $v == '.' || $v == '..') continue;
    			if(is_file($file.$val.'/'.$v)) $views[$n['dir']][$key]['file'][$k]['x'] = $v;
    			$views[$n['dir']][$key]['file'][$k]['l'] = $file.$val.'/'.$v;
    			
    		}
    	}
    	
    	}
    	
    	$code = file_get_contents($_GET['file']);

    	
    	$this->assign('views',$views);
    	
    	$this->assign('code',$code);
    	
		$this->assign('menus',array('A'=>'界面','B'=>'模板编辑'));
    	$this->display();
    }
}