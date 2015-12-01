<?php
namespace Admin\Controller;
class navController extends CommonController {
	
	protected $table = 'nav';
	
	public function index(){
		
		//$this->assign('option',$arr);
		$this->assign('type',nav_tree(0,0));

		$this->assign('menus',array('A'=>'系统','B'=>'导航栏目'));

		$this->display();
	}
	
	public function edit(){
	    $this->assign('menus',array('A'=>'系统','B'=>'导航栏目'));
		$model = M($this->table);
		$map = array();
		$map['id'] = $_GET['id'];
		$app = $_GET['app'];
		$arr = $model->where($map)->find();
		//$this->assign('options',option_nav(0, 2));
		$this->assign('options',option_nav(0, 2,NULL,$_GET['id']));
		$this->assign('x',$arr);
		$this->display();
	
	}
	
	public function form(){
	
		$model = M($this->table);
		// $app = $_GET['app'];
		
		// $this->assign('options',option_nav(0, 2));
		// //	echo option_tree(1, 0);
		// $this->display('tog:navForm');

		if(IS_POST){
			$data = array();
			$data['name']      = $_POST['name'];
			$data['parent_id'] = $_POST['parent_id'];
			$data['links']     = $_POST['links'];
			$data['icon']      = $_POST['thumb'];
			$data['status']    = $_POST['status'];

			if(!empty($_GET['id'])) $ret = $model->where(array('id'=>$_GET['id']))->save($data);
			else $ret = $model->add($data);				
		}
		if($ret)  $this->success("操作成功");
	    $this->success("操作失败");
	}
	
	public function insert(){
	
	    $this->assign('menus',array('A'=>'系统','B'=>'导航栏目'));

	    $this->assign('options',option_nav(0, 2));
		//if($ret)  $this->success("操作成功");
	    $this->display();
	}
	
	public function del(){
	
		$model = M($this->table);
		$id    = $_GET['id'];
		$map   = array();
		$data  = array();
		$data['status'] = -1;
		$map['id'] = $id;
		$ret  = $model->where($map)->save($data);
		echo $ret;
	
	}
	
}