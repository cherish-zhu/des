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
		self::$title = $ret['name'] .'_'.parent::$title['value'];
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
		
		if($method == 'search'){
			$this->search($_GET['keyword']);
			exit();
		}
		
        $gid = (int)getCategoryId(ACTION_NAME);
        $exp = explode("_", $_GET['id']);
        $id  = $exp[1] ?  $exp[1] : I('get.id');

        $cate_info = getCategory($gid);

		if(!isset($_GET['id'])){
			if($gid == 0){
				$this->display("public:tips");
				return false;
			}
			M("category")->where(array('id'=>$gid))->setInc("hits");						
			
			if($cate_info['app'] == 2)
				$this->albums($gid);
			else 
				$this->cate_list($gid);			
			
			$this->assign('cate_info',$cate_info);
			$this->assign('title',$this->title);
            $this->assign('keywords',$cate_info['keywords']);
            $this->assign('description',$cate_info['description']);
		    if(!empty($cate_info['view'])){
			    $this->display($cate_info['view']);
		    }else{
			    $this->display('list');
		    }

            return false;
		}

        $this->assign("bng",breadcrumbNavigation($id));

        if($cate_info['app'] == 2)
        	$this->album($gid,$id);
        else
        	$this->center($gid,$id);		
		
	}

	public function center($cate_id,$id){
		$center = M("center");
		$center->join(C('DB_PREFIX')."center_count ON ".C('DB_PREFIX')."center_count.center_id = ".C('DB_PREFIX')."center.id","LEFT")
		->join(C('DB_PREFIX')."center_hits ON ".C('DB_PREFIX')."center.id = ".C('DB_PREFIX')."center_hits.center_id","LEFT")
		->join(C('DB_PREFIX')."category ON ".C('DB_PREFIX')."center.cate_id = ".C('DB_PREFIX')."category.id","LEFT");
		$center->field(
				array(
						C('DB_PREFIX').'center.*',
						C('DB_PREFIX').'center_count.*',
						C('DB_PREFIX').'center_hits.*',
						C('DB_PREFIX').'category.id',
						C('DB_PREFIX').'category.name',
						C('DB_PREFIX').'category.alias',
						C('DB_PREFIX').'category.icon',
						C('DB_PREFIX').'center.id' => 'cid'
				)
		);
		$arr = $center->where(array(C('DB_PREFIX').'center.id'=>$id))->find();
		if(empty($arr)){
			$this->display("Public:tips");
			return false;
		}
	
		M("center_hits")->where(array('center_id'=>$id))->setInc("hits");
		$this->assign('center',$arr);
		$this->assign('title',$arr['title'] .'_'.self::$title );
		$this->assign('keywords',$arr['tags']);// 赋值分页输出
		$this->assign('description',$arr['description']);
		if(!empty($arr['view'])) $this->display($arr['view']);
		else
			$this->display('center');
	}
	
	public function foot(){
		M("center_count")->where(array('center_id'=>$_GET['id']))->setInc("foot");
	}
	
	public function praise(){
		M("center_count")->where(array('center_id'=>$_GET['id']))->setInc("praise");
	}
	
	protected function search($keyword){
		$search = new SearchController();
		$search->index($keyword);
	}
	
	protected function album($gid,$id){
		$id = urldecode($id);
		$model = M('category');
		$cateInfo = $model ->where(array('alias' => $id))->find();

		$model->where(array('id'=>$cateInfo['id']))->setInc("hits");
		$center = M('album');
		$map = array();
		$nums = 1;
		
		$map['status'] = '1';
		$map['cate_id'] = $cateInfo['id'];
		
		import('ORG.Util.Page');//导入分页类
		$count = $center->where($map)->count();
		$page       = new Page($count,$nums);
		$show       = $page->show();

		$center->where($map)->order('id DESC');
		
		$center->limit($page->firstRow . ',' . $page->listRows);
		$arr = $center->select();

		$this->assign('page',$show);// 赋值分页输出
		
		$this->assign('center',$arr[0]);
		$this->assign('cateInfo',$cateInfo);
		$this->assign('name',$cateInfo['name']);
		$this->assign('alias',ACTION_NAME);
		$this->assign('title',$cateInfo['name'] .'_'.self::$title );
		$this->assign('keywords',$cateInfo['tags']);// 赋值分页输出
		$this->assign('description',$cateInfo['description']);
		$this->display('center');
	}
	
	protected function albums($id){
		$model = M('category');
		$cateInfo = $model->where(array('id' => $id))->find();
		$map = array();
		$nums = $cateInfo['page'];
		
		$map['status'] = '1';
		$map['parent_id'] = $id;
		$map['app'] = '0';
		
		import('ORG.Util.Page');//导入分页类
		$count = $model->where($map)->count();
		$page       = new Page($count,$nums);
		$show       = $page->show();
		
		$model->where($map)->order('id DESC');
		
		$model->limit($page->firstRow . ',' . $page->listRows);
		$arr = $model->select();

		$this->assign('page',$show);// 赋值分页输出
		
		$this->assign('cate',$cateInfo);
		$this->assign('arr',$arr);
		$this->assign('page',$show);// 赋值分页输出
	}
	
	public function cate_list($id){

		$ret['id'] = $id;
		
		$map = array();
		
		$cateInfo = M('category')->where(array('id' => $id))->find();
		
		$center = M("center");
		
		$nums = $cateInfo['page'];
		
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
			array(
					C('DB_PREFIX').'center.*',
					C('DB_PREFIX').'center_count.*',
					C('DB_PREFIX').'center_hits.*',
					C('DB_PREFIX').'category.id',
					C('DB_PREFIX').'category.name',
					C('DB_PREFIX').'category.alias',
					C('DB_PREFIX').'category.icon',
					C('DB_PREFIX').'center.id' => 'cid'
			)
		);
		$center->where($map)->order(C('DB_PREFIX').'center.id DESC');
		
		$center->limit($page->firstRow . ',' . $page->listRows);
		$arr = $center->select();

		$this->assign('arr',$arr);
		$this->assign('page',$show);// 赋值分页输出
		
	}
	
	
}