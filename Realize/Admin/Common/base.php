<?php


//公共函数
function toDate($time, $format = 'Y-m-d H:i:s') {
    if (empty ( $time )) {
        return '';
    }
    $format = str_replace ( '#', ':', $format );
    return date ($format, $time );
}

function getStatus($status, $imageShow = true) {
    switch ($status) {
        case 0 :
            $showText = '禁用';
            $showImg = '<IMG SRC="__PUBLIC__/Images/locked.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="禁用">';
            break;
        case 2 :
            $showText = '待审';
            $showImg = '<IMG SRC="__PUBLIC__/Images/prected.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="待审">';
            break;
        case - 1 :
            $showText = '删除';
            $showImg = '<IMG SRC="__PUBLIC__/Images/del.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="删除">';
            break;
        case 1 :
        default :
            $showText = '正常';
            $showImg = '<IMG SRC="__PUBLIC__/Images/ok.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="正常">';

    }
    return ($imageShow === true) ?  $showImg  : $showText;

}

function getNodeGroupName($id) {
    if (empty ( $id )) {
        return '未分组';
    }
    if (isset ( $_SESSION ['nodeGroupList'] )) {
        return $_SESSION ['nodeGroupList'] [$id];
    }
    $Group = D ( "Group" );
    $list = $Group->getField ( 'id,title' );
    $_SESSION ['nodeGroupList'] = $list;
    $name = $list [$id];
    return $name;
}

function showStatus($status, $id) {
    switch ($status) {
        case 0 :
            $info = '<a href="javascript:resume(' . $id . ')">恢复</a>';
            break;
        case 2 :
            $info = '<a href="javascript:pass(' . $id . ')">批准</a>';
            break;
        case 1 :
            $info = '<a href="javascript:forbid(' . $id . ')">禁用</a>';
            break;
        case - 1 :
            $info = '<a href="javascript:recycle(' . $id . ')">还原</a>';
            break;
    }
    return $info;
}


function getGroupName($id) {
    if ($id == 0) {
        return '无上级组';
    }
    if ($list = F ( 'groupName' )) {
        return $list [$id];
    }
    $dao = D ( "Role" );
    $list = $dao->select( array ('field' => 'id,name' ) );
    foreach ( $list as $vo ) {
        $nameList [$vo ['id']] = $vo ['name'];
    }
    $name = $nameList [$id];
    F ( 'groupName', $nameList );
    return $name;
}

function pwdHash($password, $type = 'md5') {
    return hash ( $type, $password );
}

 function css($c){
    return '/Static/admin/css/'.$c.'.css';
 }

 
 function host_url(){
  	$opt = M("option");
  	$opt_arr = $opt->where(array('key'=>'host_url'))->select();
  	return $opt_arr[0]['value'];
 }
 function host_dir(){
 	  $opt = M("option");
   	$opt_arr = $opt->where(array('key'=>'host_dir'))->select();
   	return $opt_arr[0]['value'];
 }
 
 /**
  * 无限分类
  * 通过递归法实现无限分类查询，表category
  * 
  * @param int $fid 开始查询的id
  * @param int $count 级数
  * @param string $list 控制列出的级数，无参则为无限级
  * @return array
  * @author Cherish.Zhu
  */
 function type_tree($fid,$app,$count,$list=NULL){
   	//$tree = array();
   	$count = $count + 1;
  
   	if($list!=NULL && $count == $list){
   		break;
   	}
   	$model = M('category');
   	$map   = array();
   	$map['parent_id'] = $fid;
   	$map['status'] = array('gt','-1');
   	$ret = $model->where($map)->order('sort desc')->select();
   	$n   = str_pad('',$count,'-',STR_PAD_RIGHT);
   	$n   = str_replace("-","&nbsp;&nbsp;&nbsp;&nbsp;",$n);
   	$str = '';
      foreach($ret as $k => $v){
   		$where = array();
   		$where[$k]['parent_id'] = $v['id'];
   		$where[$k]['status'] = array('gt','-1');
   		$tree = $model->where($where[$k])->find();
      if($count == 1) $app = $v['id'];
   		if(is_array($tree)){
   		 			$x = '&gt;&gt';
   		}else{
   		 			$x='';
   		}
   		
   		if($count > 1){
   		    $str .='<div class="category-line category-id-'.$v['parent_id'].'">';
   		    $cz = '<a href="/admin/category/edit?app='.$app.'&id='.$v['id'].'">编辑</a>&nbsp;&nbsp<a href="javascript:viod(0)" class="delete-category" id="delete-category-id-'.$v['id'].'">删除</a>';
   		}else{
   		    $str .= '<div class="category-box">';
   		}
   			
   		$str.='<div class="category-id">ID:'.$v['id'].'</div>
            <div class="category-name">'.$n.$v['name'].'</div>
            <div class="category-alias">别名:'.$v['alias'].'</div>
            <div class="category-cap"  id="id-'.$v['id'].'"><i class="angle right icon"></i></div>
            <div class="category-action">操作:<a href="/admin/category/insert?id='.$v['id'].'">添加子分类</a>&nbsp;&nbsp;'.$cz.'</div>';
   		if(is_array($tree)){
   		 			$ret[$k]['son'] = true;
   		 			$str.= type_tree($ret[$k]['id'],$app,$count,$list);
   		}
   		if($count > 1) $str .= '<div class="category-clear"></div></div>';
   		else $str.='<div class="category-clear"></div></div>';
   		
       }   
   	return $str;
   	
}
 
 
 /**
  * 无限分类
  * 通过递归法实现无限分类查询，表category
  *
  * @param int $fid 开始查询的id
  * @param int $count 级数
  * @param string $list 控制列出的级数，无参则为无限级
  * @return array
  * @author Cherish.Zhu
  */
 function cate_tree($fid,$count,$list=NULL,$id){
  	//$tree = array();
  	$count = $count + 1;
  	if($list!=NULL && $count == $list){
  		break;
  	}
  	$model = M('category');
  	$map   = array();
  	$map['parent_id'] = $fid;
  	$map['status'] = array('gt','-1');
  	$ret = $model->where($map)->order('sort desc')->select();
  	$n   = str_pad('',$count,'-',STR_PAD_RIGHT);
  	$n   = str_replace("-","&nbsp;&nbsp;&nbsp;&nbsp;",$n);
  	$str = '';
  	foreach($ret as $k => $v){
      $str .= '<div class="category-line category-id-'.$v['parent_id'].'" level="'.$count.'">';
  		$where = array();
  		$where[$k]['parent_id'] = $v['id'];
  		$where[$k]['status'] = array('gt','-1');
  		$tree = $model->where($where[$k])->find();
      if($id == $v['id']) $check = ' checked="checked"';
      else $check = '';
 		  $str.='<div class="category-id"><input type="radio" class="ed" id="square-radio-'.$v['id'].'" name="cate_id" '.$check.'></div>
                 <div class="category-name">'.$n.$v['name'].'</div>
                 <div class="category-cap"  id="id-'.$v['id'].'"><i class="angle right icon"></i></div>';
 		  if(is_array($tree)){
 			$ret[$k]['son'] = true;
 			$str.= cate_tree($ret[$k]['id'],$count,$list);
 		  }
     $str .= '<div class="category-clear"></div></div>';
  	}
    

 	  return $str;
 
 }
 
 /**
  * 无限分类
  * 通过递归法实现无限分类查询，表category
  *
  * @param int $fid 开始查询的id
  * @param int $count 级数
  * @param string $list 控制列出的级数，无参则为无限级
  * @return array
  * @author Cherish.Zhu
  */
 function option_tree($fid,$count,$list=NULL,$id=NULL){
   	//$tree = array();
   //	if($fid == 2) return ;
   	$count = $count + 1;

   	if($list!=NULL && $count == $list){
   		break;
   	}
   	$model = M('category');
   	$map   = array();
   	$map['parent_id'] = $fid;
   	$map['status'] = array('gt','-1');
   	$ret = $model->where($map)->order('sort desc')->select();
   	$n   = str_pad('',$count,'-',STR_PAD_RIGHT);
   	$n   = str_replace("-","&nbsp;&nbsp;&nbsp;&nbsp;",$n);
   	$str = '';
   	foreach($ret as $k => $v){
   		  $where = array();
     		$where[$k]['parent_id'] = $v['id'];
     		$where[$k]['status'] = array('gt','-1');
     		$tree  = $model->where($where[$k])->find();
     		$check = $model->where(array('parent_id'=>$v['id'],'id'=>$id))->find();
     		if(is_array($tree)){
     			  $x = '&gt;&gt';
     		}else{
     			  $x='';
     		}
     		$sel = '';
     		if(!empty($check)) $sel = ' selected="selected"';
     		$str.='<option value="'.$v['id'].'"'.$sel.'>'.$n.$v['name'].'</option>';
     		if(is_array($tree)){
     			  $ret[$k]['son'] = true;
     			  $str.= option_tree($ret[$k]['id'],$count,$list,$id);
     		}
   
   	}
   
   	return $str;
 
 }
 
 /**
  * 无限分类
  * 通过递归法实现无限分类查询，表category
  *
  * @param int $fid 开始查询的id
  * @param int $count 级数
  * @param string $list 控制列出的级数，无参则为无限级
  * @return array
  * @author Cherish.Zhu
  */
 function option_nav($fid,$count,$list=NULL,$id=NULL){

 	    $count = $count + 1;

    	if($list!=NULL && $count == $list){
    		  break;
    	}
    	$model = M('nav');
    	$map   = array();
    	
    	$map['parent_id'] = $fid;
    	$map['status'] = array('gt','-1');
    	$ret = $model->where($map)->order('sort desc')->select();
    	$n   = str_pad('',$count,'-',STR_PAD_RIGHT);
    	$n   = str_replace("-","&nbsp;&nbsp;&nbsp;&nbsp;",$n);
    	$str = '';
    	foreach($ret as $k => $v){
    		  $where = array();
      		$where[$k]['parent_id'] = $v['id'];
      		$where[$k]['status'] = array('gt','-1');
      		$tree  = $model->where($where[$k])->find();
      		$check = $model->where(array('parent_id'=>$v['id'],'id'=>$id))->find();
      		if(is_array($tree)){
      			  $x = '&gt;&gt';
      		}else{
      			  $x='';
      		}
      		$sel = '';
      		if(!empty($check)) $sel = ' selected="selected"';
      		$str.='<option value="'.$v['id'].'"'.$sel.'>'.$n.$v['name'].'</option>';
      		if(is_array($tree)){
      			  $ret[$k]['son'] = true;
      			  $str.= option_nav($ret[$k]['id'],$count,$list,$id);
      		}
    
    	}
    
    	return $str;
 
 }
 
 /**
  * 无限分类
  * 通过递归法实现无限分类查询，表nav
  *
  * @param int $fid 开始查询的id
  * @param int $count 级数
  * @param string $list 控制列出的级数，无参则为无限级
  * @return array
  * @author Cherish.Zhu
  */
  function nav_tree($fid,$count,$list=NULL){


       $count = $count + 1;   

       if($list!=NULL && $count == $list){
           break;
       }
       $model = M('nav');
       $map   = array();
       $map['parent_id'] = $fid;
       $map['status'] = array('gt','-1');
       $ret = $model->where($map)->order('sort desc')->select();
       $n   = str_pad('',$count,'-',STR_PAD_RIGHT);
       $n   = str_replace("-","&nbsp;&nbsp;&nbsp;&nbsp;",$n);
       $str = '';
       foreach($ret as $k => $v){
           $where = array();
           $where[$k]['parent_id'] = $v['id'];
           $where[$k]['status'] = array('gt','-1');
           $tree = $model->where($where[$k])->find();
           // if($count == 1) $app = $v['id'];
           if(is_array($tree)){
                 $x = '&gt;&gt';
           }else{
                 $x='';
           }
           
           if($count > 1){
               $str .='<div class="category-line category-id-'.$v['parent_id'].'">';
           }else{
               $str .= '<div class="category-box">';
           }
           $cz = '<a href="/admin/nav/edit?id='.$v['id'].'">编辑</a>&nbsp;&nbsp<a href="javascript:viod(0)" class="delete-category" id="delete-category-id-'.$v['id'].'">删除</a>';
           $str.='<div class="category-id">ID:'.$v['id'].'</div>
                 <div class="category-name">'.$n.$v['name'].'</div>
                 <div class="category-alias">链接:'.$v['links'].'</div>
                 <div class="category-cap"  id="id-'.$v['id'].'"><i class="angle right icon"></i></div>
                 <div class="category-action">操作:<a href="/admin/nav/insert?id='.$v['id'].'">添加子分类</a>&nbsp;&nbsp;'.$cz.'</div>';
           if(is_array($tree)){
                 $ret[$k]['son'] = true;
                 $str.= nav_tree($ret[$k]['id'],$count,$list);
           }
           if($count > 1) $str .= '<div class="category-clear"></div></div>';
           else $str.='<div class="category-clear"></div></div>';
       
        }   
       return $str;
 
 }
 
 function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=false){
 
     if(function_exists("mb_substr")){
 
         if($suffix) return mb_substr($str, $start, $length, $charset)."...";
         else return mb_substr($str, $start, $length, $charset);
 
     }elseif(function_exists('iconv_substr')) {
 
         if($suffix) return iconv_substr($str,$start,$length,$charset)."..."; 
         else return iconv_substr($str,$start,$length,$charset);
 
     }
 
     $re['utf-8']  = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/"; 
     $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
     $re['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
     $re['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
 
     preg_match_all($re[$charset], $str, $match);
 
     $slice = join("",array_slice($match[0], $start, $length));
 
     if($suffix) return $slice."…";
 
     return $slice;
 
 }