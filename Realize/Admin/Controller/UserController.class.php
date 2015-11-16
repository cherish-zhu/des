<?php
namespace Admin\Controller;
use Org\Util\Page;
// 后台用户模块
class UserController extends CommonController {
	
	public $table = 'user';
    
    
    public function index(){
    	
    	$map = array();
    	
    	$model = M($this->table);
    	
    	//取得满足条件的记录数
    	$count = $model->where($map)->count('id');
    	
    	if ($count > 0) {
    		import("@.ORG.Util.Page");
    		//创建分页对象
    		if (!empty($_REQUEST ['listRows'])) {
    			$listRows = $_REQUEST ['listRows'];
    		} else {
    			$listRows = '';
    		}
    		$p = new Page($count, $listRows);
    		//分页跳转的时候保证查询条件
    		foreach ($map as $key => $val) {
    			if (!is_array($val)) {
    				$p->parameter .= "$key=" . urlencode($val) . "&";
    			}
    		}
    		$voList = $model->where($map)->limit($p->firstRow . ',' . $p->listRows)->select();
    		$page = $p->show();
    		
    		$this->assign('users', $voList);
    		$this->assign("page", $page);
    	}

    
//         $data = M("user_option"); // 实例化User对象
//         import('ORG.Util.Page');//导入分页类
//         $count= $data->where('status>-1')->count();
//         $page       = new Page($count,11);
//         $show       = $page->show();
//         //$nowPage = isset($_GET['p'])?$_GET['p']:0;
//         //$Page->listRows = $nowPage*5;
//         $user = $data->where('status > -1')->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
//         $this->assign('page',$show);// 赋值分页输出
    
//         $this->assign("user",$user);
        $this->assign('menus',array('A'=>'用户','B'=>'用户列表'));
        $this->display();
    }
    
    public function pw_edit(){
        $this->display();
    }
    
    public function update(){

    	$data = $_POST['key'];
    	$data = explode('-',$data);
    	$where['uid'] = $map['id'] = $_SESSION['user_id'];
    	switch($data[0]){
    		case 'nickname': 
    			M('user')->where($map)->save(array($data[0] => $data[1]));
    		break;
    		case 'believe':
    			M('user_list')->where($where)->save(array($data[0] => $data[1]));
    		break;
    		case 'birthday':
    			M('user_list')->where($where)->save(array($data[0] => $data[1]));
    		break;
    		case 'province':
    			M('user_communication')->where($where)->save(array($data[0] => $data[1]));
    			break;
    		case 'city':
    			M('user_communication')->where($where)->save(array($data[0] => $data[1]));
    			break;
    		case 'county':
    			M('user_communication')->where($where)->save(array($data[0] => $data[1]));
    			break;
    		case 'address':
    			M('user_communication')->where($where)->save(array($data[0] => $data[1]));
    		break;
    		case 'sex':
    			M('user_list')->where($where)->save(array($data[0] => $data[1]));
    		break;
    		case 'blood':
    			M('user_list')->where($where)->save(array($data[0] => $data[1]));
    		break;
    		case 'name':
    			M('user_list')->where($where)->save(array($data[0] => $data[1]));
    		break;
    		case 'edu':
    			M('user_list')->where($where)->save(array($data[0] => $data[1]));
    		break;
    		case 'school':
    			M('user_list')->where($where)->save(array($data[0] => $data[1]));
    			break;
    		case 'job':
    			M('user_list')->where($where)->save(array($data[0] => $data[1]));
    			break;
    		case 'individual':
    			M('user_list')->where($where)->save(array($data[0] => $data[1]));
    			break;
    	}
    }
    
    public function userGroup(){
        $this->assign('bj',array(
            'xp' => 'use',
            'tb' => 'gro'
        ));
        $this->display();
    }
    
    public function addUser(){
        $this->display();
    }
    public function userPower(){
        $this->assign('bj',array(
            'xp' => 'use',
            'tb' => 'pow',
            'str' => '权限设置',
            'url' => '/admin/userPower'
        ));
        $this->display();
    }
    
    public function userMenu(){
        $this->assign('bj',array(
            'xp' => 'use',
            'tb' => 'menu',
            'str' => '菜单设置',
            'url' => '/admin/userMenu'
        ));
        $this->display();
    }
    
    public function size_edit(){
    	
    	$model = M("user");
    	$where['id'] = $_SESSION['user_id'];
    	$ad = new AddressController();
    	$info = $model->join(C('DB_PREFIX')."user_list ON ".C('DB_PREFIX')."user_list.uid = ".C('DB_PREFIX')."user.id","LEFT")->join(C('DB_PREFIX')."user_communication ON ".C('DB_PREFIX')."user.id = ".C('DB_PREFIX')."user_communication.uid")->where($where)->find();
    	$this->assign('u',$info);
    	$this->assign('pro',$ad->_city($info['province']));
    	$this->assign('cit',$ad->_county($info['city']));
        $this->display("userInfo");
    }
    
    public function user_add(){
        $this->display();
    }
    
    public function user_del(){
        $this->display();
    }
    
    function _filter(&$map){
        $map['id'] = array('egt',2);
        if(!empty($_POST['account'])) {
            $map['account'] = array('like',"%".$_POST['account']."%");
        }
    }

    // 检查帐号
    public function checkAccount() {
        if(!preg_match('/^[a-z]\w{4,}$/i',$_POST['account'])) {
            $this->error( '用户名必须是字母，且5位以上！');
        }
        $User = M("User");
        // 检测用户名是否冲突
        $name  =  $_REQUEST['account'];
        $result  =  $User->getByAccount($name);
        if($result) {
            $this->error('该用户名已经存在！');
        }else {
            $this->success('该用户名可以使用！');
        }
    }

    // 插入数据
    public function insert() {
        // 创建数据对象
        $User	 =	 D("User");
        if(!$User->create()) {
            $this->error($User->getError());
        }else{
            // 写入帐号数据
            if($result	 =	 $User->add()) {
                $this->addRole($result);
                $this->success('用户添加成功！');
            }else{
                $this->error('用户添加失败！');
            }
        }
    }

    protected function addRole($userId) {
        //新增用户自动加入相应权限组
        $RoleUser = M("RoleUser");
        $RoleUser->user_id	=	$userId;
        // 默认加入网站编辑组
        $RoleUser->role_id	=	3;
        $RoleUser->add();
    }

    //重置密码
    public function resetPwd() {
        $id  =  $_POST['id'];
        $password = $_POST['password'];
        if(''== trim($password)) {
            $this->error('密码不能为空！');
        }
        $User = M('User');
        $User->password	=	md5($password);
        $User->id			=	$id;
        $result	=	$User->save();
        if(false !== $result) {
            $this->success("密码修改为$password");
        }else {
            $this->error('重置密码失败！');
        }
    }
}