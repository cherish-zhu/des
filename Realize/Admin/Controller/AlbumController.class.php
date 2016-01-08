<?php
namespace Admin\Controller;
use Org\Util\Page;
/**
 * 相册类
 * 包括控制台对相册管理的相关操作
 * 
 * @version 1.0
 * @author Cherish.Zhu
 */

class albumController extends CommonController {
    
    public $table = array(
        'type'  => 'category',
        'album' => 'album'
    );
    
    public $offset = 32;
	
	//相册管理首页
	public function index(){
		$type = M('category');
		$map  = array();
		$map['parent_id'] = 2;
		$map['status']    = array('neq' , '-1'); 
		$arr = $type->where($map)->order('sort desc')->select();
		$where = array();
		foreach ($arr as $k=>$v){
			$where['parent_id'] = $v['id'];
			$where['status']    = array('neq' , '-1'); 
			$arr[$k]['son'] = $type->where($where)->order('sort desc')->select();
		}
		$data['cid'] = $arr[0]['parent_id'];
		$where = array();
		$where['parent_id'] = $data['cid'];
		$where['status'] = array('neq' , '-1');
		$aid = $type->where($where)->order('sort desc')->select();
		$data['aid'] = $aid[0]['id'];
		
		$album = $type->where(array('id'=>$_GET['album'] ? $_GET['album'] : $_GET['category']))->find();

		!empty($_GET['ajax']) ? $this->assign('pic',$this->picture()) : $this->assign('pic',$this->picture('array'));
				
		$this->assign('album',$album);
		$this->assign('option',$arr);
		$this->assign('str',$data);
		$this->assign('menus',array('A'=>'应用','B'=>'图片相册'));
		$this->display();
	}
	
	public function lib(){
		$cid = $_GET['cid'];
		$r = M($this->table['category']);
		$a = $r->where("`fid`={$cid} and `status`<>'-1'")->select();
		exit(json_encode($a));
	}
	
	public function change_img(){
		$pic = M($this->table['album']);
		
		$page = !empty($_GET['page']) ? $_GET['page'] : 1;
		$page = $page - 1;
		
		$sum = $page*24;
	
		$cate = M($this->table['type']);
		$where['parent_id'] = 2;
		$map['status'] = $where['status'] = '1';
		if($_GET['cate_id'] != '')  $map['cate_id'] = $_GET['cate_id'];	
		$count = $pic->where($map)->count();
		$option = $cate->where($where)->select();
		$op = array();
		$arr = $pic->where($map)->limit($sum,24)->select();
		//echo $pic->getLastSql();
		foreach ($option as $key => $val){
			$op[$key] = $val;
			$where['parent_id'] = $val['id'];
			$op[$key]['son'] = $cate->where($where)->select();
		}
		$this->assign('option',$op);
		$this->assign('list',$arr);
		$this->assign('count',$count);
		if($_GET['_ajaxs']){
			echo json_encode(array('count'=>$count,'data'=>$arr));
		}else{
			$this->display();
		}
		
	}
	
	public function picture($tye = 'json'){
	    $pic = M($this->table['album']);
		$album = $_GET['album'] ? intval($_GET['album']) : $_GET['category'];
		$page  = intval($_GET['p'])-1;
		$sum = $this->offset * $page;
		
		$map = array();
		$map['status'] = 1;
		if(!empty($album)) $map['cate_id']  = $album;
		
		import('ORG.Util.Page');//导入分页类
		$count= $pic->where($map)->count();
		$paged      = new Page($count,32);
		$show       = $paged->show();
		
		
		if($page < 0) $sum = 0;
		    
		$pic->limit($sum,$this->offset);
		
		$this->assign('page',$show);// 赋值分页输出
		
		$arr = $pic->where($map)->select();
		//if($arr==null) exit(json_encode(array('code'=>0)));
		
		if($tye == 'json') echo json_encode($arr);
		else return $arr;
	}
	
	public function set(){
	    $this->assign('bj',array(
	        'xp'  => 'app',
	        'tb'  => 'oth',
	        'str' => '相册',
	        'url' => '/admin/album/set'
	    ));
		$this->display();
	}
	
	public function edit(){
		$type = M($this->table['category']);
		$id = $_GET['id'];
		if($_POST){
			$data['name'] = trim($_POST['name']);
			$data['fid'] = intval($_POST['type']);
			$data['status'] = $_POST['auto'];
			$data['keyword'] = trim($_POST['keyword']);
			$data['description'] = trim($_POST['description']);
			$data['alias'] = trim($_POST['alias']);
			$s = $type->where(array('cid'=>$id))->save($data);
			$this->success('编辑成功', 'type');
			exit;
		}
		$arr = $type->where('cid='.$id)->select();		
		$this->assign('option',$type->where('fid=2 and status>=0')->select());
		$this->assign('val',$arr[0]);
		$this->assign('bj',array(
		   'xp' => 'app',
		   'tb' => 'alb'
		));
		$this->display();
	}
	
	public function edit_pic(){
		$type = M($this->table['album']);
		$cate = M($this->table['type']);
		$id = $_GET['id'];
		$fid = $_GET['fid'];
		if($_POST){
			$data['title'] = trim($_POST['name']);
			$data['cate_id'] = intval($_POST['album']);
			$data['keyword'] = trim($_POST['keyword']);
			$data['description'] = trim($_POST['description']);
			$s = $type->where(array('id'=>$id))->save($data);
			$this->success('编辑成功', 'index');
			exit;
		}
		$arr = $type->where(array('id'=>$id))->find();
		$map['parent_id'] = 2;
		$map['status'] = $where['status'] ='1';
		$option = $cate->where($map)->select();
		$op = array();
		foreach ($option as $key => $val){
			$op[$key] = $val;
			$where['parent_id'] = $val['id'];
			$op[$key]['son'] = $cate->where($where)->select();
		}
		$this->assign('option',$op);
		$this->assign('val',$arr);
		$this->assign('bj',array(
		   'xp' => 'app',
		   'tb' => 'alb'
		));
		$this->display();
	}
	
	public function del_pic(){
		$type = M($this->table['album']);
		$id = $_GET['id'];
		$data['status'] = '-1';
		$s = $type->where(array('id'=>$id))->save($data);
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
	
	public function del(){
		$type = M($this->table['type']);
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
	
	public function type(){
// 		$type = M($this->table['type']);
// 		$map = array();
// 		$map['parent_id'] = 2;
// 		$map['status']    = array('gt','-1');
// 		$arr = $type->where($map)->select();
// // 		foreach ($arr as $k=>$v){
// // 		   $arr[$k]['son'] = type_tree($arr[$k]['cid'],0);
// // 		}
		$this->assign('type',type_tree(2,1,0));
		$this->assign('bj',array(
		   'xp'  => 'app',
		   'tb'  => 'type',
		   'str' => '相册',
		   'url' => '/admin/album/type'
		));
		$this->display();
	}
	
	public function paixu(){
		$type = M($this->table['category']);
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
		
		$type = M($this->table['category']);
		$data['name'] = trim($_POST['name']);
		$data['fid'] = intval($_POST['type']);
		$data['status'] = $_POST['auto'];
		$data['icon'] = $_POST['ico'];
		$data['keyword'] = trim($_POST['keyword']);
		$data['description'] = trim($_POST['description']);
		$data['alias'] = trim($_POST['alias']);
		$data['ord'] = 999;
		$s = $type->data($data)->add();
		if($s)
			$this->success('新增成功', 'type');
		else 
			$this->error('新增失败');
	}
}