<?php
namespace Admin\Controller;
class NodeController extends CommonController {
	
	public $table = 'node';
	
    public function _filter(&$map){
        if(!empty($_GET['group_id'])) {
            $map['group_id'] =  $_GET['group_id'];
            $this->assign('nodeName','分组');
        }elseif(empty($_POST['search']) && !isset($map['pid']) ) {
            $map['pid']	=	0;
        }
        if($_GET['pid']!=''){
            $map['pid']=$_GET['pid'];
        }
        $_SESSION['currentNodeId']	=	$map['pid'];
        //获取上级节点
        $node  = M("Node");
        if(isset($map['pid'])) {
            if($node->getById($map['pid'])) {
                $this->assign('level',$node->level+1);
                $this->assign('nodeName',$node->name);
            }else {
                $this->assign('level',1);
            }
        }
    }
    
    public function index(){
    	
    	$model = M($this->table);
    	
    	$map = array();
    	
    	$map['status'] = 1;
        if($_GET['fid']) $map['group_id']  = I('get.fid');
    	else $map['group_id']  = 0;
    	
    	$nodes = $model->where($map)->order('id asc')->select();
    	
    	foreach ($nodes as $key => $val){
    		
    		$map['pid'] = $val['id'];
    		$nodes[$key]['son'] = $model->where($map)->select();
    		if(!empty($nodes[$key]['son'])){
    			$map['pid'] = $v['id'];
    			foreach ($nodes[$key]['son'] as $k => $v){
    				$nodes[$key]['son'][$k]['son'] = $model->where($map)->select();
    			}
    			
    		}
    		
    	}
    	
    	$this->assign('nodes',$nodes);
    	
    	$this->assign('menus',array('A'=>'用户','B'=>'节点管理'));
    	$this->display();
    	
    }

    public function add(){
        $model = M($this->table);
        if(IS_POST){
            if($data = $model->create()){
                $model->group_id = I('post.parent_id');
                $model->status = 1;
                if($model->add()){
                    $this->success("操作成功");
                    return true;
                }
                $this->success("操作失败");
            }
            return false;
        }
        $this->assign('menus',array('A'=>'用户','B'=>'节点管理'));
        $this->display();
    }

    public function edit(){

        $model = M($this->table);
        $id = I('get.id');
        $this->assign('x',$model->where(array('id'=>$id))->find());
        if(IS_POST){
            if($data = $model->create()){
                if($model->where(array('id'=>$id))->save($data)){
                    $this->success("操作成功");
                    return true;
                }
                $this->success("操作失败");
            }
            return false;
        }
        $this->assign('menus',array('A'=>'用户','B'=>'节点管理'));
        $this->display();
    }

    public function del(){
        $id = I('get.id');
        $model = M($this->table);
        if($model->where(array('id'=>$id))->delete()){
            $this->success("操作成功");
            return true;
        }
        $this->success("操作失败");
    }

    /**
     * 默认排序操作
     * @access public
     * @return void
     */
    public function sort()
    {
        $node = M('Node');
        if(!empty($_GET['sortId'])) {
            $map = array();
            $map['status'] = 1;
            $map['id']   = array('in',$_GET['sortId']);
            $sortList   =   $node->where($map)->order('sort asc')->select();
        }else{
            if(!empty($_GET['pid'])) {
                $pid  = $_GET['pid'];
            }else {
                $pid  = $_SESSION['currentNodeId'];
            }
            if($node->getById($pid)) {
                $level   =  $node->level+1;
            }else {
                $level   =  1;
            }
            $this->assign('level',$level);
            $sortList   =   $node->where('status=1 and pid='.$pid.' and level='.$level)->order('sort asc')->select();
        }
        $this->assign("sortList",$sortList);
        $this->display();
        return ;
    }
}