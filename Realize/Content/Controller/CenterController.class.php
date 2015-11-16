<?php
namespace Content\Controller;
use Think\Controller;
use Org\Util\Page;
class CenterController extends BaseController {
	
	static $title,$cate_name,$cate_alias,$cate_id;
	
	public function __construct(){
		parent::__construct();
		$alias = $_GET['alias'];
		$cate  = M("category");
		$where = array();
		if($alias != NULL) $where['alias'] = $alias;
		
		$ret = $cate->where($where)->find();
		self::$title = $ret['name'] .' - '.parent::$title['value'];
		self::$cate_id = $ret['id'];
		$this->assign('title',self::$title );
		$this->assign('keywords',$ret['keyword']);// 赋值分页输出
		$this->assign('description',$ret['description']);
		$this->assign('cate',$ret);
	}
	
	public function index(){
		
		//echo D('Denter')->test();
		$cate  = M("category");
		$center = M("center");
		$hot = $center->where(array('cate_id'=>self::$cate_id,'status'=>1))->join(C('DB_PREFIX')."center_hits ON ".C('DB_PREFIX')."center.id = ".C('DB_PREFIX')."center_hits.center_id","LEFT")->order('hits desc')->limit(10)->select();
		for ($i=0;$i<10;$i++){
			if(empty($hot[$i]['id'])) break;
			$cat = $cate->where(array('id'=>$hot[$i]['cate_id']))->find();
			$hot[$i]['cate_name'] = $cat['name'];
			$hot[$i]['cate_alias'] = $cat['alias'];
		}
		$this->assign('hot',$hot);
		
		if(!empty($_GET['id']) && !empty($_GET['alias'])){
			$this->center(self::$cate_id,$_GET['id']);
		}
		
		if (!empty($_GET['alias']) && empty($_GET['id'])) {
			$this->cate_list(self::$cate_id);
		}
		
	}
	
	public function center($cate_id,$id){
		$center = M("center");
		$center->join(C('DB_PREFIX')."center_count ON ".C('DB_PREFIX')."center_count.center_id = ".C('DB_PREFIX')."center.id","LEFT")
		->join(C('DB_PREFIX')."center_hits ON ".C('DB_PREFIX')."center.id = ".C('DB_PREFIX')."center_hits.center_id","LEFT");
		$arr = $center->where(array('id'=>$id))->find();
		M("center_hits")->where(array('center_id'=>$_GET['id']))->setInc("hits");
		$this->assign('center',$arr);
		$this->assign('title',$arr['title'] .' - '.self::$title );
		$this->assign('keywords',$arr['tags']);// 赋值分页输出
		$this->assign('description',$arr['description']);
		$this->display('center');
	}
	
	public function foot(){
		M("center_count")->where(array('center_id'=>$_GET['id']))->setInc("foot");
	}
	
	public function praise(){
		M("center_count")->where(array('center_id'=>$_GET['id']))->setInc("praise");
	}
	
	public function cate_list($id){
		
		$ret['id'] = $id;
		
		$map = array();
		
		$center = M("center");
		
		
		if($_GET['alias'] == 'meifa'){
			$nums = 12;
		}elseif ($_GET['alias'] == 'hufu'){
			$nums = 5;
		}else{
			$nums = 9;
		}
		
		$map['cate_id'] = $ret['id'];
		$map['status'] = 1;
		
		import('ORG.Util.Page');//导入分页类
		$count= $center->where($map)->count();
		$page       = new Page($count,$nums);
		$show       = $page->show();
		
		$center->join(C('DB_PREFIX')."center_count ON ".C('DB_PREFIX')."center_count.center_id = ".C('DB_PREFIX')."center.id","LEFT")
		->join(C('DB_PREFIX')."center_hits ON ".C('DB_PREFIX')."center.id = ".C('DB_PREFIX')."center_hits.center_id","LEFT");
		
		
		$center->where($map)->order('id asc');
		
		$center->limit($page->firstRow . ',' . $page->listRows);
		$arr = $center->select();
		
		// 		echo $center->getLastSql();
		// 		print_r($arr);
		$cate  = M("category");
	    for ($i=0;$i<$page->listRows;$i++){
			if(empty($arr[$i]['id'])) break;
			$cat = $cate->where(array('id'=>$arr[$i]['cate_id']))->find();
			$arr[$i]['cate_name'] = $cat['name'];
			$arr[$i]['cate_alias'] = $cat['alias'];
		}

		$this->assign('arr',$arr);
		$this->assign('page',$show);// 赋值分页输出
		
		if($_GET['alias'] == 'meifa'){
			$this->display('index2');
		}elseif ($_GET['alias'] == 'hufu'){
			$pse = $center->where($map)->join(C('DB_PREFIX')."center_count ON ".C('DB_PREFIX')."center_count.center_id = ".C('DB_PREFIX')."center.id","LEFT")->order('praise desc')->limit(4)->select();
			$this->assign('pse',$pse);
			$this->display('index1');
		}else{
			$this->display('index');
		}
		
	}
	
	
}