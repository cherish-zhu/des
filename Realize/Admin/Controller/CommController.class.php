<?php
namespace Admin\Controller;
use Org\Util\Page;
class commController extends CommonController {
    public function index(){
		
		$data = M("comm"); // 实例化User对象
		import('ORG.Util.Page');//导入分页类
		$count= $data->where('status>-1 and sort=0')->count();
		$page       = new Page($count,11);
		$show       = $page->show();
		//$nowPage = isset($_GET['p'])?$_GET['p']:0;
		//$Page->listRows = $nowPage*5;
		$comm = $data->where('status > -1 and sort=0')->order('comm_id')->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('page',$show);// 赋值分页输出
		
        $this->assign('menus',array('A'=>'应用','B'=>'网络链接'));

        $this->assign("comm",$comm);
	    $this->display();
    }

}