<?php
namespace Ucenter\Controller;
use Think\Controller;
use Org\Util\Rbac;
class PublicController extends Controller{
    
	public $seKey     = 'verdify'; //验证码加密密钥
	
	public function  __construct(){
		header("Content-type: text/html; charset=utf-8");
		parent::__construct();
	}

	public function index(){

	}
	
	public function verify() {
		$config  =   array(
				'fontSize'    =>    18,    // 验证码字体大小
				'length'      =>    4,     // 验证码位数
				'imageH'      =>    34, // 关闭验证码杂点
				'useNoise'    =>    false, // 关闭验证码杂点
				'useCurve'    =>    false,
		);
		$verify = new \COM\Verify($config);
		$verify->entry();
		//         $type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
		//         import("ORG.Util.Image");
		//         Image::buildImageVerify(4,1,$type);
	}
	
	/* 加密验证码 */
	private function authcode($str){
		$key = substr(md5($this->seKey), 5, 8);
		$str = substr(md5($str), 8, 10);
		return md5($key . $str);
	}
	
	public function login(){

		if($_POST){
			if(empty($_POST['account'])) {
				$this->error('帐号错误！');
			}elseif (empty($_POST['password'])){
				$this->error('密码必须！');
			}elseif (empty($_POST['verify'])){
			$this->error('验证码必须！');
			 }
			//生成认证条件
			$map            =   array();
			// 支持使用绑定帐号登录
			$map['account']	= $_POST['account'];
			$map["status"]	=	array('gt',0);
			$session = session($this->authcode($this->seKey));
			$verdify = $this->authcode(strtoupper($_POST['verify']));
			if($session['code'] != $verdify) {
			  $this->error('验证码错误！');
			 }
			import ( 'ORG.Util.RBAC' );
			$authInfo = RBAC::authenticate($map);
			//使用用户名、密码和状态的方式进行认证
			if(false === $authInfo) {
			
				$code = 0;
				$msg  = '用户名或者密码错误!';
			
				$this->error('帐号不存在或已禁用！');
			}else {
				if($authInfo['password'] != md5($_POST['password'])) {
					$this->error('密码错误！');
				}
				$_SESSION[C('USER_AUTH_KEY')]	=	$authInfo['id'];
				$_SESSION['email']	=	$authInfo['email'];
				$_SESSION['user_id'] = $authInfo['id'];
				$_SESSION['loginUserName']		=	$authInfo['nickname'];
				$_SESSION['lastLoginTime']		=	$authInfo['last_login_time'];
				$_SESSION['login_count']	=	$authInfo['login_count'];
				if($authInfo['account']=='admin') {
					$_SESSION['administrator']		=	true;
				}
				//保存登录信息
				$User	=	M('User');
				$ip		=	get_client_ip();
				$time	=	time();
				$data = array();
				$data['id']	=	$authInfo['id'];
				$data['last_login_time']	=	$time;
				$data['login_count']	=	array('exp','login_count+1');
				$data['last_login_ip']	=	$ip;
				$User->save($data);
			
				// 缓存访问权限
				RBAC::saveAccessList();
// 				$code = 1;
// 				$msg  = '登陆成功!';
			
				$this->success('登录成功！',__APP__.'/Index/index');
			
			}
			
			//echo json_encode(array('status'=>1,'info'=>'登录成功'));
			return ;
		}
		$this->display();
	}
	
	public function reg(){
		
		if($_POST){
			
			$account = trim($_POST['account']);
			$password = trim($_POST['password']);
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$nickname = $_POST['nickname'];
			//echo $_POST['nickname'];
			if(empty($account)) {
				$this->error('帐号错误！');
			}elseif (empty($password)){
				$this->error('密码必须！');
			}elseif (empty($_POST['verify'])){
				$this->error('验证码必须！');
			}
			//生成认证条件
			$map            =   array();
			// 支持使用绑定帐号登录
			$map['account']	= $_POST['account'];
			$map["status"]	=	array('gt',0);
			$session = session($this->authcode($this->seKey));
			$verdify = $this->authcode(strtoupper($_POST['verify']));
			if($session['code'] != $verdify) {
				$this->error('验证码错误！');
			}
			
			$model = M('user');
			
			
			$map = array();			
			$map['account'] = $account;
			$map['phone'] = $phone;
			$map['email'] = $email;		
			$map['_logic'] = 'OR';
			$ret = $model->where($map)->find();
			if(!empty($ret)){
				if($ret['account'] == $account){
					$this->error('帐号已经被注册！');
				}elseif($ret['email'] == $email){
					$this->error('邮箱已经被注册！');
				}elseif($ret['phone'] == $phone){
					$this->error('手机号码已经被注册！');
				}
			}
			
			$data = array(
					'id'        => NULL,
 					'account'   => $account,
					'nickname'  => $nickname,
					'password'  => md5($password),
					'phone'     => $phone,
					'email'     => $email,
					'last_login_time' => time(),
					'last_login_ip' => get_client_ip(),
					'login_count'   => 1,
					'status'        => 1,
					'create_time'   => time(),
					'update_time'   => time()			         
			);
			
			$id = $model->add($data);
			if($id > 0){
				M("user_property")->add(array('uid'=>$id,'species'=>100));
				M("user_list")->add(array('uid'=>$id));
				M("user_communication")->add(array('uid'=>$id,'species'=>100));			
				echo json_encode(array('info'=>'注册成功！','status'=>1));
			}else{
				echo json_encode(array('info'=>'系统错误！','status'=>0));
			}
			return ;
		}
		
		$this->display();
	}

}