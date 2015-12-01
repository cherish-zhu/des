<?php
namespace Admin\Controller;
use Org\Util\Page;
class contentController extends CommonController {
	
	public function write(){

		$this->assign('option',$arr);
		
		$this->assign('cate_tree',cate_tree(1,0));
		
		if($_POST){
			
			$add = M('center');
            $center = array();
			$center['id']          = NULL;
			$center['cate_id']     = $_POST['cateid'];
			$center['title']       = $_POST['title'];
			$center['thumb']       = $_POST['thumb'];
			$center['center']      = $_POST['content'];
			$center['tags']        = $_POST['tags'];
			$center['description'] = $_POST['description'];
			$center['view']        = $_POST['view'];
			$center['user_id']     = $_SESSION['user_id'] ? $_SESSION['user_id'] : 1;
			$center['create_time'] = time();	
			$center['type']        = $_POST['type'];
			$center['comm']        = $_POST['comm'] ? $_POST['comm'] : 1;
			$center_id = $add->add($center);

            if($center_id > 0){
            	$limit = M('center_limit');
            	$data  = array();
            	$data['center_id'] = $center_id;
                if(!empty($_POST['passwd'])){
                	$data['type']      = $_POST['passwd'];
                	$data['value']     = $_POST['passwd_value'];
                }elseif (!empty($_POST['users'])){
                	$data['type']      = $_POST['users'];
                	$data['value']     = '';
                }elseif (!empty($_POST['vip'])){
                	$data['type']      = $_POST['vip'];
                	$data['value']     = '';
                }elseif (!empty($_POST['group'])){
                	$data['type']      = $_POST['group'];
                	$data['value']     = '';
                }elseif (!empty($_POST['buy'])){
                	switch ($_POST['buy_type']){
                		case '0' :
                			$data['type']      = 'money';
                		break;
                		case '1' :
                			$data['type']      = 'score';
                		break;
                		case '3' :
                			$data['type']      = 'piece';
                		break;
                	}
                	$data['value']     = $_POST['buy_value'];
                }else{
                	$data['type']      = 'all';
                	$data['value']     = '';
                }
            	$limit_id = $limit->add($data); 
            	$hits_id  = M('center_hits')->add(array('center_id'=>$center_id));
            	$count_id = M('center_count')->add(array('center_id'=>$center_id));
            }
            
            if($center_id > 0 and $limit_id > 0) $this->success('新增成功', 'write');
		    else $this->error($add->getError());
		 	   
		    return ;
		   
		}
		$this->assign('menus',array('A'=>'应用','B'=>'内容管理'));
		$this->display();
	}
	
	
	public function edit(){
		$where['id'] = $map['center_id'] = $_GET['id'];
		//->join("center_limit ON center.id = center_limit.center_id")
		$arr = M('center')->where($where)->find();
	    $this->assign('alt',$arr);
		
		$this->assign('option',$arr);

		$this->assign('cate_tree',cate_tree(1,0,null,$arr['cate_id']));
		
		if($_POST){
				
			$add = M('center');
			$center = array();
			$center['cate_id']     = $_POST['cateid'];
			$center['thumb']       = $_POST['thumb'];
			$center['title']       = $_POST['title'];
			$center['center']      = $_POST['content'];
			$center['tags']        = $_POST['tags'];
			$center['description'] = $_POST['description'];
			$center['view']        = $_POST['view'];
			$center['user_id']     = $_SESSION['user_id'] ? $_SESSION['user_id'] : 1;
			$center['create_time'] = time();
			$center['type']        = $_POST['type'];
			$center['comm']        = $_POST['comm'] ? $_POST['comm'] : 1;
			$center_id = $add->where($where)->save($center);
		//echo $add->getLastSql();
		//return  ;
			if($center_id > 0){
				$limit = M('center_limit');
				$data  = array();
				$data['center_id'] = $center_id;
				if(!empty($_POST['passwd'])){
					$data['type']      = $_POST['passwd'];
					$data['value']     = $_POST['passwd_value'];
				}elseif (!empty($_POST['users'])){
					$data['type']      = $_POST['users'];
					$data['value']     = '';
				}elseif (!empty($_POST['vip'])){
					$data['type']      = $_POST['vip'];
					$data['value']     = '';
				}elseif (!empty($_POST['group'])){
					$data['type']      = $_POST['group'];
					$data['value']     = '';
				}elseif (!empty($_POST['buy'])){
					switch ($_POST['buy_type']){
						case '0' :
							$data['type']      = 'money';
							break;
						case '1' :
							$data['type']      = 'score';
							break;
						case '3' :
							$data['type']      = 'piece';
							break;
					}
					$data['value']     = $_POST['buy_value'];
				}else{
					$data['type']      = 'all';
					$data['value']     = '';
				}
				$limit_id = $limit->where($map)->save($data);
			}
		
			if($center_id > 0 and $limit_id > 0) $this->success('修改成功', 'write');
			else $this->error($add->getError());
				
			return ;
			 
		}
		$this->assign('menus',array('A'=>'应用','B'=>'内容管理'));
		$this->display();
		
	}
	
	public function read(){
		
		$data = M('center'); // 实例化User对象
		import('ORG.Util.Page');//导入分页类
		$count= $data->count();
		$page       = new Page($count,6);
		$show       = $page->show();
		//$nowPage = isset($_GET['p'])?$_GET['p']:0;
		//$Page->listRows = $nowPage*5;
		$where = array();
		$where['status'] = 1;
		$center = $data->where($where)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
		$this->assign('page',$show);// 赋值分页输出
		
		$this->assign("center",$center);
		$this->assign('menus',array('A'=>'应用','B'=>'内容管理'));
		$this->display();
	}
	
	public function set(){
	    $this->assign('bj',array(
	        'xp' => 'app',
	        'tb' => 'set',
	        'str' => '内容',
	        'url' => '/admin/content/set'
	    ));
		$this->display();
	}
	
	public function delete(){
		$model = M('center');
		$id = $_GET['id'];
		$data['status'] = '-1';
		$s = $model->where(array('id'=>$id))->save($data);
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
	
	public function type(){
// 		$type = M('class');
// 		$arr = $type->where("`fid`=1 and `status`<>'-1'")->order('ord desc')->select();
// 		foreach ($arr as $k=>$v){
// 			$arr[$k]['son'] = type_tree($arr[$k]['cid'],0);
// 		}
		$this->assign('type',type_tree(1,1,0));
		$this->assign('bj',array(
		   'xp' => 'app',
		   'tb' => 'cat',
		    'str' => '内容',
		    'url' => '/admin/content/type'
		));
		$this->display();
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
	
		$type = D('Class');
		$type->create();
		$type->class_name = trim($_POST['name']);
		$type->fid = intval($_POST['type']);
		$type->status = $_POST['auto'];
        $type->alias = trim($_POST['alias']);
		$data['alias'] = trim($_POST['alias']);		
		if($type->add())
			$this->success('新增成功', 'type');
		else
			$this->error($type->getError());
	}
	
}