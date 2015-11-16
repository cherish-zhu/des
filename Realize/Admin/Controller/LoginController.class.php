<?php
namespace Admin\Controller;
class loginController extends CommonController {
	
	public function index(){
		$this->display('Index:window');
	}
	//登陆验证
	public function check(){
		
		$username = $_POST['username'];
		$pw = $_POST['password'].C('PW_KEY');
		$pw   = md5($pw);	
		$user = M('user_option');	
		$where['username'] = $username;
		$where['password'] = $pw;
		$user_info = $user->where($where)->find();

		if($user_info['password'] === $pw){
			$code = 1;
			$msg  = '登陆成功!';
			$_SESSION['username'] = $user_info['username'];
			$_SESSION['id']       =  $user_info['id'];
			$_SESSION['check']    = md5($user_info['username'].$user_info['password']);
			
		}else{
			$code = 0;
			$msg  = '用户名或者密码错误!';
		}
		
		exit(json_encode(array(
		    'code'=> $code,
			'msg' => $msg,
		    
		)));
	}
	//退出登陆 销毁session
	public function checkout(){
		
		if(session_destroy())		
		exit(json_encode(array(
		    'code'=> 1,
			'msg' => '注销登陆'
		)));
	}
}