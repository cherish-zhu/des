<?php
namespace Content\Controller;
use Think\Controller;
class BaseController extends Controller {
	
	static $beian , $name , $title, $title2 , $keyword, $description,$bei,  $url;
	
	public function __construct(){
        parent::__construct();
		if(is_file(MODULE_PATH . 'Data/install.lock')){
			$this->error('请安装Destroy!', U('Install/Index/index'));
		}
		$option = M('option');
		self::$name = $option->where(array('key'=>'host_name'))->find();
		self::$title = $option->where(array('key'=>'host_title'))->find();
		self::$title2 = $option->where(array('key'=>'host_title2'))->find();
		self::$keyword = $option->where(array('key'=>'host_keyword'))->find();
		self::$description = $option->where(array('key'=>'host_description'))->find();
		self::$bei = $option->where(array('key'=>'host_beian'))->find();
		self::$url  = $option->where(array('key'=>'host_url'))->find();
		
		if(!empty(self::$title2['value'])) self::$title2['value'] = ' - '.self::$title2['value'];
		
		$this->assign("name",self::$name['value']);
		$this->assign("title",self::$title['value'].self::$title2['value']);
		$this->assign("keywords",self::$keyword['value']);
		$this->assign("description",self::$description['value']);
		$this->assign("beian",self::$beian['value']);
		$this->assign("url",self::$url['value']);
        $this->assign("nav",M("nav")->where(array('status'=>'1','parent_id'=>'0'))->select());
        $this->assign("hdp",$this->hdp());
	}
	
	/**
	 * 取得内容
	 * 
	 * @param string $type 内容属性
	 * @param number $list 取得内容条数
	 * @param number $order 排序，数组参数,排序字段id,sort [asc,desc] eg . array('id','asc');
     * @param string $alias 根据别名查找分类
	 * @param string $cate_id 根据id查找分类
	 * @return array
	 */
	protected function content_list($type = NULL,$list = 5,$order = NULL,$alias = NULL,$cate_id = NULL){
		
		$cate  = M("category");
		$where = array();
		if($alias != NULL) $where['alias'] = $alias;
		if($cate_id != NULL) $where['id'] = $cate_id;
		$ret = $cate->where($where)->find();
		
		$map = array();
		$center = M("center");
		$center->join(C('DB_PREFIX')."center_count ON ".C('DB_PREFIX')."center_count.center_id = ".C('DB_PREFIX')."center.id","LEFT")
		       ->join(C('DB_PREFIX')."center_hits ON ".C('DB_PREFIX')."center.id = ".C('DB_PREFIX')."center_hits.center_id","LEFT");
		if($cate_id != NULL) $map['cate_id'] = $ret['id'];
		if($alias != NULL) $map['cate_id'] = $ret['id'];
		if($type != NULL) $map['type'] = $type;
		$map['status'] = '1';
		$center->where($map);
		!empty($order['id']) ? $center->order($order['id'] .' '.$order[1]) : $center->order('id desc');
		!empty($order['sort']) ? $center->order($order['sort'] .' '.$order[1]) : $center->order('id desc');
		$center->limit($list);
		$arr = $center->select();
		for ($i=0;$i<$list;$i++){
			if(empty($arr[$i]['id'])) break;
			$cat = $cate->where(array('id'=>$arr[$i]['cate_id']))->find();
			$arr[$i]['cate_name'] = $cat['name'];
			$arr[$i]['cate_alias'] = $cat['alias'];
		}

		return $arr;
	}
	
	protected function hdp(){
		
		return M("nav")->where(array('parent_id'=>11))->select();
		
	}
	
}