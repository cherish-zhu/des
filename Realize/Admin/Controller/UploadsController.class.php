<?php
namespace Admin\Controller;
class uploadController extends CommonController {
	
	public $arrType  = array('image/jpg','image/gif','image/png','image/bmp','image/pjpeg','image/jpeg','application/octet-stream');
	public $max_size = '500000000000';      // 最大文件限制（单位：byte）
	public $upfile   = 'webroot/upload/pic/photo/'; //图片目录路径
	public $thumbfile= 'webroot/upload/pic/thumb/'; //图片缩略图路径
	public $thumbW   = 100;//缩略图最大宽度
	public $thumbH   = 100;//缩略图最大宽度
	public $file;
	public $url ;     
	public $thumb    = true;//缩略图
	public $dr_file  ; 
	public $sonFile; //终极目录
	
	public function __construct(){
		parent::__construct();
		$this->url = host_url();
		if(PATH_SEPARATOR==':') $this->dr_file='';  
        else $this->dr_file = host_dir();
		$this->file = $_FILES['Filedata'];
		$this->sonFile = $this->createFile();//	
		$this->upfile = $_SERVER['DOCUMENT_ROOT'] . $this->dr_file.$this->upfile . $this->sonFile.'/';
		$this->thumbfile = $_SERVER['DOCUMENT_ROOT'] . $this->dr_file.$this->thumbfile . $this->sonFile.'/';
		
	}
	
	public function index(){
		
		$ret = array();
		
		$fileParts = pathinfo($_FILES['Filedata']['name']);

		if (!file_exists($this->upfile )) {

	         mkdir($this->upfile,0777,true);
			 
        }
		
		if($this->check() == 1){
			$imageSize = getimagesize($this->file['tmp_name']);
		    $img = $imageSize[0].'*'.$imageSize[1];
			$fname = $this->file['name'];
			$ftype=explode('.',$fname);
			$picName=$this->upfile.$fname;
			if($this->thumb == true){//生成缩略图
				    if (!file_exists($this->thumbfile )){
			             mkdir($this->thumbfile,0777,true);
		            }
					$imageSize=getimagesize($this->file['tmp_name']);
		            $img=$imageSize[0].'*'.$imageSize[1];
	
                    $src_image=ImageCreateFromJPEG($this->file['tmp_name']);
                    $dst_image=ImageCreateTrueColor($this->thumbW,$this->thumbH);
	   
                    ImageCopyResized($dst_image,$src_image,0,0,0,0,$this->thumbW,$this->thumbH,$imageSize[0],$imageSize[1]);
                    if(ImageJpeg($dst_image,$this->thumbfile.$this->file['name'])){
                    	$ret['name'] = $this->file['name'];
						$ret['thumbUrl'] = $this->url.$this->dr_file.'webroot/upload/pic/thumb/'. $this->sonFile.'/'.$this->file['name'];
					}
	   
			
			}
			if(move_uploaded_file($this->file['tmp_name'],$picName)){
				
				$this->insert($this->file['name'],'webroot/upload/pic/thumb/'. $this->sonFile.'/'.$this->file['name']);//数据库
				exit(json_encode($ret));
			}else{
				echo "<font color='#FF0000'>移动文件出错！</font>".$picName;
			}			
			
		}

	}
	
	public function check(){//check-exists.php
	
	    if($_SERVER['REQUEST_METHOD']=='POST'){ //判断提交方式是否为POST
			if(!is_uploaded_file($this->file['tmp_name'])){ //判断上传文件是否存在
				//echo "<font color='#FF0000'>文件不存在！</font>";
 				return 0;
				exit;
			}

			if($this->file['size']>$this->max_size){  //判断文件大小是否大于500000字节
				//echo "<font color='#FF0000'>上传文件太大！</font>";
				return 0;
				exit;
			} 
			if(!in_array($this->file['type'],$this->arrType)){  //判断图片文件的格式
				//echo "<font color='#FF0000'>上传文件格式不对！</font>xxx:".$file['type'];				$str = 0;
				return 0;
				exit;
			}
			return 1;
	    }else{
			return 0;
		}
		

	}
	
	public function createFile(){
		  $son_file = strtotime(date("Y-m-d"));
		  return $son_file;
	}
	
	public function insert($name,$path){
		$tb = M('album');
		$data['tid'] = intval($_GET['aid']);
		$data['path'] = $path;
		$data['alb_name'] = $name;
		$data['alb_time'] = strtotime(date("Y-m-d H:m:s"));
		$tb->data($data)->add();
	}

}