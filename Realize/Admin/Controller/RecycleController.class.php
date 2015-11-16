<?php
namespace Admin\Controller;
use Org\Util\Page;
class recycleController extends CommonController {
	public function index(){
		
		$data = M('center'); // 实例化User对象
		import('ORG.Util.Page');//导入分页类
		$where = array();
		$where['status'] = -1;
		$count= $data->where($where)->count();
		$page       = new Page($count,12);
		$show       = $page->show();
		//$nowPage = isset($_GET['p'])?$_GET['p']:0;
		//$Page->listRows = $nowPage*5;	
		$center = $data->where($where)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
		$this->assign('page',$show);// 赋值分页输出
		$this->assign("center",$center);
		$this->assign('menus',array('A'=>'系统','B'=>'回收站'));
		$this->display();
	}
	
	public function comments(){
		
		$data = M("comm"); // 实例化User对象
		import('ORG.Util.Page');//导入分页类
		$count= $data->where('status = -1')->count();
		$page       = new Page($count,11);
		$show       = $page->show();
		//$nowPage = isset($_GET['p'])?$_GET['p']:0;
		//$Page->listRows = $nowPage*5;
		$comm = $data->where('status = -1')->order('comm_id')->limit($page->firstRow . ',' . $page->listRows)->select();
		$this->assign('page',$show);// 赋值分页输出
		$this->assign("center",$comm);
		$this->assign('menus',array('A'=>'系统','B'=>'回收站'));
		$this->display();
	}
	
	public function links(){
		$data = M("links"); // 实例化User对象
		import('ORG.Util.Page');//导入分页类
		$count= $data->where('type = 0')->count();
		$page       = new Page($count,11);
		$show       = $page->show();
		//$nowPage = isset($_GET['p'])?$_GET['p']:0;
		//$Page->listRows = $nowPage*5;
		$link = $data->where('type = 0')->order('lid')->limit($page->firstRow . ',' . $page->listRows)->select();
		$this->assign('page',$show);// 赋值分页输出
		$this->assign("center",$link);
		$this->assign('menus',array('A'=>'系统','B'=>'回收站'));
		$this->display();
	}
	
	public function albums(){
		$this->display();
	}
	
	public function window(){
		$this->display();
	}
	 
	public function user_main(){
		$this->display("userMain");
	}
}