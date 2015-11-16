<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Util\Admin;
use Common\Util\Page;
class AdminController extends Controller {
	public $User,$uid,$userInfo;
	public function _initialize(){
		if (false == \Admin\Util\Rbac::AccessDecision(MODULE_NAME)) {
			//检查是否登录
			if (false === \Admin\Util\Rbac::checkLogin()) {
				//跳转到登录界面
				$this->redirect(C('USER_AUTH_GATEWAY'));
			}
			//没有操作权限
			$this->error('您没有操作此项的权限！');
		}
		//验证登录
		$this->User = $this->verification();
		$admin = new Admin();
		$this->userInfo = $admin->getInfo();
		$this->uid = $this->userInfo['id'];
		if(!empty($this->User)){
			unset($this->User['password']);
			$this->assign('User',$this->User);
		}else{
			$this->error('用户资料有误！');
		}
		$this->assign("Menu", D("AdminMenu")->getMenuList());
	}
	/**
	 * 验证登录
	 * @return boolean
	 */
	private function verification() {
		//检查是否登录
		$id = (int) \Admin\Util\Admin::getInstance()->isLogin();
		if (empty($id)) {
			return false;
		}
		//获取当前登录用户信息
		$userInfo = \Admin\Util\Admin::getInstance()->getInfo();
		if (empty($userInfo)) {
			\Admin\Util\Admin::getInstance()->logout();
			return false;
		}
		//是否锁定
		if (!$userInfo['status']) {
			\Admin\Util\Admin::getInstance()->logout();
			$this->error('您的帐号已经被锁定！', U('Public/login'));
			return false;
		}
		return $userInfo;
	}
	
	/**
	 * 写入操作日志
	 * @param String $info 操作说明
	 * @param type $status 状态,1为写入，2为更新，3为删除
	 * @param type $data 数据
	 */
	final protected function addLog($info, $status = 1, $data = array()) {
	    $uid = $this->uid;
	    unset($data['_info'], $data['_status'], $data['_info']);
	    $data = serialize($data);
	    $data['GET'] = $_SERVER['HTTP_REFERER'];
	    $data['POST'] = $_POST;
	    M("Logs")->add(array(
	        "uid" => $uid,
	        "time" => NOW_TIME,
	        "ip" => get_client_ip(),
	        "status" => $status,
	        "info" => $info,
	        "data" => serialize($data)
	    ));
	}
	
	/**
	 * 通用分页列表数据集获取方法
	 *
	 *  可以通过url参数传递where条件,例如:  index.html?name=asdfasdfasdfddds
	 *  可以通过url空值排序字段和方式,例如: index.html?_field=id&_order=asc
	 *  可以通过url参数r指定每页数据条数,例如: index.html?r=5
	 *
	 * @param sting|Model  $model   模型名或模型实例
	 * @param array        $where   where查询条件(优先级: $where>$_REQUEST>模型设定)
	 * @param array|string $order   排序条件,传入null时使用sql默认排序或模型属性(优先级最高);
	 *                              请求参数中如果指定了_order和_field则据此排序(优先级第二);
	 *                              否则使用$order参数(如果$order参数,且模型也没有设定过order,则取主键降序);
	 *
	 * @param boolean      $field   单表模型用不到该参数,要用在多表join时为field()方法指定参数
	 * @author 朱亚杰 <xcoolcc@gmail.com>
	 *
	 * @return array|false
	 * 返回数据集
	 */
	protected function lists ($model,$where=array(),$order='',$field=true){
	    $options    =   array();
	    $REQUEST    =   (array)I('request.');
	    if(is_string($model)){
	        $model  =   M($model);
	    }
	
	    $OPT        =   new \ReflectionProperty($model,'options');
	    $OPT->setAccessible(true);
	
	    $pk         =   $model->getPk();
	    if($order===null){
	        //order置空
	    }else if ( isset($REQUEST['_order']) && isset($REQUEST['_field']) && in_array(strtolower($REQUEST['_order']),array('desc','asc')) ) {
	        $options['order'] = '`'.$REQUEST['_field'].'` '.$REQUEST['_order'];
	    }elseif( $order==='' && empty($options['order']) && !empty($pk) ){
	        $options['order'] = $pk.' desc';
	    }elseif($order){
	        $options['order'] = $order;
	    }
	    unset($REQUEST['_order'],$REQUEST['_field']);
	
	    if(empty($where)){
	        $where  =   array('status'=>array('egt',0));
	    }
	    if( !empty($where)){
	        $options['where']   =   $where;
	    }
	    $options      =   array_merge( (array)$OPT->getValue($model), $options );
	    $total        =   $model->where($options['where'])->count();
	
	    if( isset($REQUEST['r']) ){
	        $listRows = (int)$REQUEST['r'];
	    }else{
	        $listRows = C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
	    }
	    $page = new Page($total, $listRows, $REQUEST);
	    if($total>$listRows){
	        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
	    }
	    $p =$page->show();
	    $this->assign('page', $p? $p: '');
	    $this->assign('total',$total);
	    $options['limit'] = $page->firstRow.','.$page->listRows;
	
	    $model->setProperty('options',$options);
	
	    return $model->field($field)->select();
	}
	
}