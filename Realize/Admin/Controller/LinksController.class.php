<?php
namespace Admin\Controller;
use Org\Util\Page;
class linksController extends CommonController {
	public function index(){
		$type = M('class');
		$arr = $type->where("`fid`=3 and `status`<>'-1'")->order('ord desc')->select();
		foreach ($arr as $k=>$v){
			$arr[$k]['son'] = type_tree($arr[$k]['cid'],0);
		}
		$this->assign('option',$arr);
		
		$data = M("links"); // 实例化User对象
		import('ORG.Util.Page');//导入分页类
		$count= $data->where('type>-1')->count();
		$page       = new Page($count,11);
		$show       = $page->show();
		//$nowPage = isset($_GET['p'])?$_GET['p']:0;
		//$Page->listRows = $nowPage*5;
		$link = $data->where('type > -1')->order('lid')->limit($page->firstRow . ',' . $page->listRows)->select();
		$this->assign('page',$show);// 赋值分页输出
		
		$this->assign("link",$link);
		
		if(IS_POST){
			$add = M('links');
			$data['lid']   = NULL;
			$data['sort']  = $_POST['type'];
			$data['name']  = $_POST['name'];
			$data['links'] = $_POST['links'];
			$data['order'] = '999';
			$data['type']  = '1';
			$data['icon']  = '';
			$s = $add->data($data)->add();
			if($s)
				$this->success('新增成功', 'links');
			else
				$this->error('新增失败');
			exit;
		}
		$this->assign('menus',array('A'=>'应用','B'=>'网络链接'));
		$this->display();
	}

	public function type(){
		$type = M('class');
		$arr = $type->where("`fid`=3 and `status`<>'-1'")->order('ord desc')->select();
		foreach ($arr as $k=>$v){
			$arr[$k]['son'] = type_tree($arr[$k]['cid'],0);
		}
		$this->assign('option',$arr);
		$this->assign('bj',array(
		   'xp' => 'app',
		   'tb' => 'lin'
		));
		$this->display();
	}
	
	public function del(){
		$type = M('class');
		$id = $_GET['id'];
		$data['status'] = '-1';
		$s = $type->where(array('cid'=>$id))->save($data);
		if($s)
			exit(json_encode(array(
					'code' => 1,
					'msg'  => '删除成功'
			)));
		else
			exit(json_encode(array(
					'code' => 0,
					'msg'  => '删除失败'
			)));
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
	
		$type = M('class');
		$data['class_name'] = trim($_POST['name']);
		$data['fid'] = intval($_POST['type']);
		$data['status'] = $_POST['auto'];
		$data['class_icon'] = $_POST['ico'];
		$data['class_keyword'] = trim($_POST['keyword']);
		$data['class_description'] = trim($_POST['description']);
		$data['alias'] = trim($_POST['alias']);
		$data['ord'] = 999;
		$s = $type->data($data)->add();
		if($s)
			$this->success('新增成功', 'type');
		else
			$this->error('新增失败');
	}

}