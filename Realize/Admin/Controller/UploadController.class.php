<?php
namespace Admin\Controller;
use Org\Util\UploadFiles;
class uploadController extends CommonController {
	
	protected $thumbFile ;
	
	public function __construct(){
		
		$this->thumbFile = './Data/Uploads/thumb/' . date('Ymd', time()) . '/';
		
	}
	
	public function index(){

		import('ORG.Util.UploadFile');
		
		$upload = new \Think\UploadFile();// 实例化上传类
		$upload->maxSize = 8000000 ;// 设置附件上传大小  C('UPLOAD_SIZE');
		$upload->savePath = './Data/Uploads/Picture/'; // 设置附件上传目录
		$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
		$upload->saveRule = 'time';
		$upload->uploadReplace = true; //是否存在同名文件是否覆盖
		$upload->thumb = true; //是否对上传文件进行缩略图处理
		$upload->thumbMaxWidth = '100,300'; //缩略图处理宽度
		$upload->thumbMaxHeight = '50,150'; //缩略图处理高度
		//$upload->thumbPrefix = $prefix; //缩略图前缀
		$upload->thumbPrefix = 'm_,s_';  //生产2张缩略图
		if(!file_exists($this->thumbFile)) mkdir ($this->thumbFile);
		$upload->thumbPath = $this->thumbFile; //缩略图保存路径

		$upload->thumbRemoveOrigin = false; //上传图片后删除原图片
		$upload->autoSub = true; //是否使用子目录保存图片
		$upload->subType = 'date'; //子目录保存规则
		$upload->dateFormat = 'Ymd'; //子目录保存规则为date时时间格式

		// 上传文件
		$info   =   $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功
			$info = $upload->getUploadFileInfo();
			$ret = array();
			$ret['name'] = explode('.', $info[0]['name']);
			$ret['name'] = $ret['name'][0];
			$ret['file'] = '/Data/Uploads/Picture/'.$info[0]['savename'];
			$ee  = explode('/', $info[0]['savename']);
			$ret['thumb'] = '/Data/Uploads/thumb/'.date('Ymd', time()) . '/m_'.$ee[1];
			$ret['m'] = $upload->thumbPath.'s_'.$ee[1];
            if($this->insert(array('cate_id'=>$_POST['cate_id'],'title'=>$ret['name'],'path'=>$ret['file'])))
			echo json_encode($ret);
			//$this->success('上传成功！');
		}
	}
	
	public function insert($u){

		$data = array(
				'cate_id' => $u['cate_id'],
		        'title'   => $u['title'],
		        'path'    => $u['path'],
		        'create_time' => time(),
		        'status'      => 1
		);
		$id = M("album")->add($data);
		return $id;
	}

}