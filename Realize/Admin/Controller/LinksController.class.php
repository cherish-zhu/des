<?php
namespace Admin\Controller;
use Org\Util\Page;
class linksController extends CommonController {

	public function index(){
		$model = M('category');
		
		$links = M("links"); // 实例化User对象
		import('ORG.Util.Page');//导入分页类
		$where['type'] = array('gt', -1);
		$count= $links->where($where)->count();
		$page       = new Page($count,11);
		$show       = $page->show();

		$link = $links->where($where)->order('id')->limit($page->firstRow . ',' . $page->listRows)->select();

		$this->assign('page',$show);// 赋值分页输出
		
		$this->assign("link",$link);
		
		
		$this->assign('menus',array('A'=>'应用','B'=>'网络链接'));
		$this->display();
	}

	public function add(){

		$links = M('links');

		if(IS_POST){
			$data['id']   = NULL;
			$data['sort']  = $_POST['sort'];
			$data['name']  = $_POST['name'];
			$data['link']  = $_POST['link'];
			$data['order'] = '999';
			$data['type']  = '1';
			$data['icon']  = $_POST['thumb'];
			$s = $links->data($data)->add();
			if($s)
				$this->success('新增成功');
			else
				$this->error('新增失败');
			exit;
		}
		$this->assign('options',option_tree(3,0));
		$this->assign('menus',array('A'=>'应用','B'=>'网络链接'));
		$this->display();

	}
	
	public function del(){
		$type = M('links');
		$id = $_GET['id'];
		$data['status'] = '-1';
		$s = $type->where(array('cid'=>$id))->save($data);
		if($s)
			exit(json_encode(array(
					'status' => 1,
					'msg'  => '删除成功'
			)));
		else
			exit(json_encode(array(
					'code' => 0,
					'status'  => '删除失败'
			)));
	}

	public function delete(){
		$model  = M('links');
		$result = $model->where(array('id'=>I('get.id')))->delete();
		if($result)
			echo json_encode(array(
					'status' => 1,
					'msg'  => '删除成功'
			));
		else
			echo json_encode(array(
					'code' => 0,
					'status'  => '删除失败'
			));
	}
	
	public function paixu(){
		$type = M('class');
		$cid = (int)$_POST['cid'];
		$id = intval($_POST['id']);
		$ret = $type->where("`cid`={$id}")->select();
		if($_POST['type']=='+')
			$ord = $ret[0]['ord']+1;
		else
			$ord = $ret[0]['ord']-1;
		$data['ord'] = $ord;
		$s = $type->where(array('cid'=>$cid))->save($data);
	}
	
	public function insert(){
	
		$type = M('links');
		// $data['class_name'] = trim($_POST['name']);
		// $data['fid'] = intval($_POST['type']);
		// $data['status'] = $_POST['auto'];
		// $data['class_icon'] = $_POST['ico'];
		// $data['class_keyword'] = trim($_POST['keyword']);
		// $data['class_description'] = trim($_POST['description']);
		// $data['alias'] = trim($_POST['alias']);
		// $data['order'] = 999;
		$s = $type->data($data)->add();
		if($s)
			$this->success('新增成功', 'type');
		else
			$this->error('新增失败');
	}

}