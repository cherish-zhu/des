<?php
namespace Content\Controller;
use Think\Controller;
use Org\Util\Page;
class SearchController extends BaseController {
    
	public function index($keyword){
		$model = M("center");
		$where = array();
		$where['status'] = '1';
		
		$where['_string'] = '(title like "%'.$keyword.'%")  OR ( center like "%'.$keyword.'")';
		
		import('ORG.Util.Page');//导入分页类
		$count = $model->where($where)->count();
		$page       = new Page($count,$nums);
		$show       = $page->show();
		
		$model->limit($page->firstRow . ',' . $page->listRows);
		$row = $model->where($where)->select();
		$this->assign('row',$row);
		$this->assign('num',$count);
		$this->assign('page',$show);
		$this->display('public:search');
	}
	
	
	
}