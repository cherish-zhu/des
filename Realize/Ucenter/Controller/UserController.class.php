<?php

namespace Ucenter\Controller;
use Ucenter\Api\UserApi as UserApi;

/**
 * 用户控制器
 * 包括用户中心，用户登录及注册
 */
class UserController extends BaseController {
	
	public $model;
	protected $thumbFile ,$user_id;
	
	public function  __construct(){
		parent::__construct();
		$this->model = M('user');
		$this->thumbFile = './data/face/';
		$this->user_id = $_SESSION['user_id'];
		$row = $this->model->where(array('id'=>$this->user_id))->find();
		$this->assign('row',$row);
	}
	
	public function index(){
		$this->assign('info',$this->model->join(C('DB_PREFIX')."user_list ON ".C('DB_PREFIX')."user.id = ".C('DB_PREFIX')."user_list.uid","LEFT")->join(C('DB_PREFIX')."user_communication ON ".C('DB_PREFIX')."user.id = ".C('DB_PREFIX')."user_communication.uid","LEFT")->where(array('id'=>$this->user_id))->find());
		$this->display();
	}
	
	public function haver(){
	
		if($_POST){
			import('ORG.Util.UploadFile');
				
			$upload = new \Think\UploadFile();// 实例化上传类
			$upload->maxSize = 8000000 ;// 设置附件上传大小  C('UPLOAD_SIZE');
			$upload->savePath = './data/face/'; // 设置附件上传目录
			$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
			$upload->saveRule = 'time';
			$upload->uploadReplace = true; //是否存在同名文件是否覆盖
			$upload->thumb = true; //是否对上传文件进行缩略图处理
			$upload->thumbMaxWidth = '100,150'; //缩略图处理宽度
			$upload->thumbMaxHeight = '100,150'; //缩略图处理高度
			//$upload->thumbPrefix = $prefix; //缩略图前缀
			$upload->thumbPrefix = 'm_,s_';  //生产2张缩略图
			if(!file_exists($this->thumbFile)) mkdir ($this->thumbFile);
			$upload->thumbPath = $this->thumbFile; //缩略图保存路径
				
			$upload->thumbRemoveOrigin = true; //上传图片后删除原图片
			$upload->autoSub = false; //是否使用子目录保存图片
			// 			$upload->subType = 'date'; //子目录保存规则
			// 			$upload->dateFormat = 'Ymd'; //子目录保存规则为date时时间格式
				
			// 上传文件
			$info   =   $upload->upload();
			if(!$info) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功
				$info = $upload->getUploadFileInfo();
				$ret = array();
				$ret['name'] = explode('.', $info[0]['name']);
				$ret['name'] = $ret['name'][0];
				$ret['file'] = './data/face/'.$info[0]['savename'];
				$ee  = explode('/', $info[0]['savename']);
				$ret['thumb'] = './data/face/m_'.$ee[0];
				$ret['m'] = $upload->thumbPath.'s_'.$ee[0];
				$map = array();
				$map['face'] = substr($ret['m'],1);
				$this->model->where(array('id'=>$this->user_id))->save($map);
				//echo json_encode($ret);
				//$this->success('上传成功！');
			}
		}
		$this->display();
	}
	
	public function passwd(){
		if($_POST){
			$pwd = user_md5($_POST['pwd']);
			$password = user_md5($_POST['password']);
			$id = $_SESSION['user_id'];
			$map = array();
			$data = array();
			$data['password'] = $password;
			$map['id'] = $id;
			$ret = $this->model->where($map)->find();
			if($ret['password'] == $pwd){
				$upd = $this->model->where($map)->save($data);
				if($upd){
					echo json_encode(array('info'=>'修改成功','status'=>1));
				}else{
					echo json_encode(array('info'=>'修改失败，系统错误','status'=>0));
				}
			}else{
	
				echo json_encode(array('info'=>'原始密码错误','status'=>0));
	
			}
			return ;
		}
		$this->display();
	}
	
	public function post(){
		$this->display();
	}
	
	public function caiwu(){
		$model = M("user_property");
		$arr = $model->where(array('uid'=>$_SESSION['user_id']))->find();
		$this->assign('ret',$arr);
	
		if($_POST){
			$map = array();
			$value = (int)$_POST['value'];
			$map['uid'] = $_SESSION['user_id'];
			$row = $model->where($map)->find();
			switch ($_POST['type']){
				case 1 :
					if($row['money']<$value){
						echo json_encode(array('info'=>'人民币不足，兑换失败','status'=>0));
					}else{
						$species = $model->where($map)->setInc('species',$value*10); // 用户的积分加1
						$money = $model->where($map)->setDec('money',$value); // 用户的积分减5
						if($species && $money){
							echo json_encode(array('info'=>'兑换成功','status'=>1));
						}else{
							echo json_encode(array('info'=>'系统错误，兑换失败','status'=>0));
						}
					}
					break;
	
				case 2 :
					if($row['species']<$value){
						echo json_encode(array('info'=>'金币不足，兑换失败','status'=>0));
					}else{
						$species = $model->where($map)->setInc('integral',$value); // 用户的积分加1
						$money = $model->where($map)->setDec('species',$value); // 用户的积分减5
						if($species && $money){
							echo json_encode(array('info'=>'兑换成功','status'=>1));
						}else{
							echo json_encode(array('info'=>'系统错误，兑换失败','status'=>0));
						}
					}
					break;
				case 3 :
					if($row['integral']<$value){
						echo json_encode(array('info'=>'积分不足，兑换失败','status'=>0));
					}else{
						$species = $model->where($map)->setInc('species',$value); // 用户的积分加1
						$money = $model->where($map)->setDec('integral',$value); // 用户的积分减5
						if($species && $money){
							echo json_encode(array('info'=>'兑换成功','status'=>1));
						}else{
							echo json_encode(array('info'=>'系统错误，兑换失败','status'=>0));
						}
					}
					break;
			}
	
			return ;
		}
	
		$this->display();
	}
	
	public function myself(){
	
		if($_POST){
			$nickname = trim($_POST['nickname']);
			$sex      = (int)$_POST['sex'];
			$name     = trim($_POST['name']);
			$birthday = trim($_POST['birthday']);
			$province = $_POST['province'];
			$city     = $_POST['city'];
			$county   = $_POST['county'];
			$qq       = (int)$_POST['qq'];
			$email    = trim($_POST['email']);
			$phone    = $_POST['phone'];
			$remark   = $_POST['remark'];
			$address  = $_POST['street'];
			echo $phone;
			M("user")->where(array('id'=>$this->user_id))->save(array(
			'nickname'    => $nickname,
			'phone'       => $phone,
			'email'       => $email,
			'remark'      => $remark
			));
			M("user_list")->where(array('uid'=>$this->user_id))->save(array(
			'qq'        => $qq,
			'name'       => $name,
			'birthday'     => $birthday,
			'sex'   => $sex
			));
			M("user_communication")->where(array('uid'=>$this->user_id))->save(array(
			'province' => $province,
			'city'     => $city,
			'county'   => $county,
			'address'  => $address
			));
		}
		$ad = new AddressController();
		$ret = $this->model->join(C('DB_PREFIX')."user_list ON ".C('DB_PREFIX')."user.id = ".C('DB_PREFIX')."user_list.uid")->join(C('DB_PREFIX')."user_communication ON ".C('DB_PREFIX')."user.id = ".C('DB_PREFIX')."user_communication.uid")->where(array('id'=>$this->user_id))->find();
		$this->assign('pro',$ad->_city($ret['province']));
		$this->assign('cit',$ad->_county($ret['city']));
		$this->assign('meb',$ret);
		$this->display();
	}
	
	public function logout(){
		if(isset($_SESSION[C('USER_AUTH_KEY')])) {
			unset($_SESSION[C('USER_AUTH_KEY')]);
			unset($_SESSION);
			session_destroy();
			$this->success('登出成功！',__URL__.'/login/');
		}else {
			$this->error('已经登出！');
		}
	}

// 	/* 用户中心首页 */
// 	public function index(){

// // 		$login = A('User/User', 'Api')->login('ss', 'aoiujz');
// // 		$login = A('User/User', 'Api')->register('ss', 'aoiujz', 'xiaoxiaoxiao@qq.com');
// // 		$login = A('User/User', 'Api')->checkEmail('zuojiazi@vip.qq.com');


// // 		dump($login);

// 		$this->display();
		
// 	}

// 	/* 注册页面 */
// 	public function register($username = '', $password = '', $repassword = '', $email = '', $verify = ''){
// 		if(IS_POST){ //注册用户
// 			/* 检测验证码 */
// 			if(!check_verify($verify)){
// 				$this->error('验证码输入错误！');
// 			}

// 			/* 检测密码 */
// 			if($password != $repassword){
// 				$this->error('密码和重复密码不一致！');
// 			}			

// 			/* 调用注册接口注册用户 */
//             $User = new UserApi;
// 			$uid = $User->register($username, $password, $email);
// 			if(0 < $uid){ //注册成功
// 				//TODO: 发送验证邮件
// 				$this->success('注册成功！',U('login'));
// 			} else { //注册失败，显示错误信息
// 				$this->error($this->showRegError($uid));
// 			}

// 		} else { //显示注册表单
// 			$this->display();
// 		}
// 	}

// 	/* 登录页面 */
// 	public function login($username = '', $password = '', $verify = ''){
// 		if(IS_POST){ //登录验证
// 			/* 检测验证码 */
// 			if(!check_verify($verify)){
// 				$this->error('验证码输入错误！');
// 			}

// 			/* 调用UC登录接口登录 */
// 			$user = new UserApi;
// 			$uid = $user->login($username, $password);
// 			if(0 < $uid){ //UC登录成功
// 				/* 登录用户 */
// 				$Member = D('Member');
// 				//此处模型需修改  login($uidd) 返回值被修改
// 				if($Member->login($uid)){ //登录用户
// 					//TODO:跳转到登录前页面
// 					$this->success('登录成功！',U('/Ucenter/User'));
// 				} else {
// 					$this->error($Member->getError());
// 				}

// 			} else { //登录失败
// 				switch($uid) {
// 					case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
// 					case -2: $error = '密码错误！'; break;
// 					default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
// 				}
// 				$this->error($error);
// 			}

// 		} else { //显示登录表单
// 			$this->display();
// 		}
// 	}

// 	/* 退出登录 */
// 	public function logout(){
// 		if(is_login()){
// 			D('Member')->logout();
// 			$this->success('退出成功！', U('User/login'));
// 		} else {
// 			$this->redirect('User/login');
// 		}
// 	}

// 	/* 验证码，用于登录和注册 */
// 	public function verify(){
// 		$verify = new \COM\Verify();
// 		$verify->entry(1);
// 	}

// 	/**
// 	 * 获取用户注册错误信息
// 	 * @param  integer $code 错误编码
// 	 * @return string        错误信息
// 	 */
// 	private function showRegError($code = 0){
// 		switch ($code) {
// 			case -1:  $error = '用户名长度必须在16个字符以内！'; break;
// 			case -2:  $error = '用户名被禁止注册！'; break;
// 			case -3:  $error = '用户名被占用！'; break;
// 			case -4:  $error = '密码长度必须在6-30个字符之间！'; break;
// 			case -5:  $error = '邮箱格式不正确！'; break;
// 			case -6:  $error = '邮箱长度必须在1-32个字符之间！'; break;
// 			case -7:  $error = '邮箱被禁止注册！'; break;
// 			case -8:  $error = '邮箱被占用！'; break;
// 			case -9:  $error = '手机格式不正确！'; break;
// 			case -10: $error = '手机被禁止注册！'; break;
// 			case -11: $error = '手机号被占用！'; break;
// 			default:  $error = '未知错误';
// 		}
// 		return $error;
// 	}


//     /**
//      * 修改密码提交
//      * @author huajie <banhuajie@163.com>
//      */
//     public function profile(){
//         if ( IS_POST ) {
//             //获取参数
//             $uid        =   is_login();
//             $password   =   I('post.old');
//             $repassword = I('post.repassword');
//             $data['password'] = I('post.password');
//             empty($password) && $this->error('请输入原密码');
//             empty($data['password']) && $this->error('请输入新密码');
//             empty($repassword) && $this->error('请输入确认密码');

//             if($data['password'] !== $repassword){
//                 $this->error('您输入的新密码与确认密码不一致');
//             }

//             $Api = new UserApi();
//             $res = $Api->updateInfo($uid, $password, $data);
//             if($res['status']){
//                 $this->success('修改密码成功！');
//             }else{
//                 $this->error($res['info']);
//             }
//         }else{
//             $this->display();
//         }
//     }

    
    
//     public function haver(){
//        $this->check();
//     	//print_r($_GET);
//     	$this->display();
//     }
    
//     public function passwd(){
//     	$this->check();
//     	//print_r($_GET);
//     	$this->display();
//     }
    
//     public function post(){
//     	$this->check();
//     	//print_r($_GET);
//     	$this->display();
//     }
    
//     public function caiwu(){
//     	$this->check();
//     	//print_r($_GET);
//     	$this->display();
//     }
    
//     public function myself(){
//     	$this->check();
//     	//print_r($_GET);
//     	$this->display();
//     }
    
//     public function check(){
//     	if(empty($_SESSION['id'])){
//     		$this->success('请登录！', U('User/login'));
//     		exit();
//     	}
//     }
    
}
