<?php
namespace Admin\Controller;
class settingController extends CommonController {
	
	public $host_dir;
	public $p = array();
	
	public function _initialize(){
		
		parent::_initialize();
		
		$opt = M("option");
		$opt_arr = $opt->select();
		foreach($opt_arr as $k=>$v){
			$this->p[$v['key']] = $v['value'];
		}
		$this->host_dir = $this->p['host_dir'];
	}
	
    public function info(){    	
    	$data = array();
		if($_POST){
			$opt = M("option");
			foreach($_POST as $k => $v){
				$data['value']=$_POST[$k];
				$opt->where(array('key'=>'host_'.$k))->save($data);
			}
			if($opt){
				$this->success('更新成功');
				
			}else{
				$this->error($opt->getError());
			}
			return ;
		}
		$this->assign('p',$this->p);
		$this->assign('bj',array(
				'tb' => 'info',
		));
		$this->assign('menus',array('A'=>'系统','B'=>'基本设置'));
	    $this->display();
    }
    
	public function set(){
		$data = array();
		if($_POST){
			$opt = M("option");
			foreach($_POST as $k=>$v){
				$data['value']=$_POST[$k];
				$opt->where(array('key'=>'host_'.$k))->save($data);
			}
			if($opt){
				$this->success('更新成功');
			
			}else{
				$this->error($opt->getError());
			}
			return ;
		}
		$this->assign('host_dir',$this->host_dir);
		$this->assign('menus',array('A'=>'系统','B'=>'基本设置'));
		$this->assign('bj',array(
		   'tb' => 'set',
		));
		$this->display();
	}
	
	public function other(){
		if($_POST){
			$opt = M("option");
			foreach($_POST as $k=>$v){
				$data['value']=$_POST[$k];
				$opt->where(array('key'=>'host_'.$k))->save($data);
			}
			if($opt){
				$this->success('更新成功');
					
			}else{
				$this->error($opt->getError());
			}
			return ;
		}
		$this->assign('menus',array('A'=>'系统','B'=>'基本设置'));
	    $this->assign('bj',array(
	        'tb' => 'other',
	    ));
	    $this->display();
	}
	
}