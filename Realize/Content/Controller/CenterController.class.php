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

	public function __call($method,$args){

        $gid = (int)getCategoryId(ACTION_NAME);
        $exp = explode("_", $_GET['id']);
        $id  = (int)$exp[1];

		if(!isset($_GET['id'])){			
			if($gid == 0){
				$this->display("Public:tips");
				return false;
			}
			$this->cate_list($gid);
			$cate_info = getCategory($gid);
			$this->assign('cate_info',$cate_info);
			$this->assign('title',$this->title);
            $this->assign('keywords',$cate_info['keywords']);
            $this->assign('description',$cate_info['description']);
		    if(!empty($cate_info['view'])){
			    $this->display($arr['view']);
		    }else{
			    $this->display('list');
		    }

            return false;
		}

        $this->assign("bng",breadcrumbNavigation($id));

		$this->center($gid,$id);
		
	}
	
	public function center($cate_id,$id){
		$center = M("center");
		$center->join(C('DB_PREFIX')."center_count ON ".C('DB_PREFIX')."center_count.center_id = ".C('DB_PREFIX')."center.id","LEFT")
		->join(C('DB_PREFIX')."center_hits ON ".C('DB_PREFIX')."center.id = ".C('DB_PREFIX')."center_hits.center_id","LEFT")
		->join(C('DB_PREFIX')."category ON ".C('DB_PREFIX')."center.cate_id = ".C('DB_PREFIX')."category.id","LEFT");
		$center->field(
			array(C('DB_PREFIX').'center.*',C('DB_PREFIX').'center_count.*',C('DB_PREFIX').'center_hits.*',C('DB_PREFIX').'category.*',C('DB_PREFIX').'center.id' => 'cid')
		);
		$arr = $center->where(array(C('DB_PREFIX').'center.id'=>$id))->find();
		if(empty($arr)){
				$this->display("Public:tips");
				return false;
		} 
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
		
		$nums = 13;
		
		$map['cate_id'] = $ret['id'];
		$map[C('DB_PREFIX').'center.status'] = '1';
		
		import('ORG.Util.Page');//导入分页类
		$count = $center->where($map)->count();
		$page       = new Page($count,$nums);
		$show       = $page->show();	
		$center->join(C('DB_PREFIX')."center_count ON ".C('DB_PREFIX')."center_count.center_id = ".C('DB_PREFIX')."center.id","LEFT")
		->join(C('DB_PREFIX')."center_hits ON ".C('DB_PREFIX')."center.id = ".C('DB_PREFIX')."center_hits.center_id","LEFT")
		->join(C('DB_PREFIX')."category ON ".C('DB_PREFIX')."center.cate_id = ".C('DB_PREFIX')."category.id","LEFT");
		$center->field(
			array(C('DB_PREFIX').'center.*',C('DB_PREFIX').'center_count.*',C('DB_PREFIX').'center_hits.*',C('DB_PREFIX').'category.*',C('DB_PREFIX').'center.id' => 'cid')
		);
		$center->where($map)->order(C('DB_PREFIX').'center.id asc');
		
		$center->limit($page->firstRow . ',' . $page->listRows);
		$arr = $center->select();

		$this->assign('arr',$arr);
		$this->assign('page',$show);// 赋值分页输出
		
	}
	
	
}