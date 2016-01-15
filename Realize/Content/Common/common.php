<?php

function getList($where,$limit,$offset = NULL,$type = NULL){
    
    $model = M('center');
    $model->join(C('DB_PREFIX')."category ON ".C('DB_PREFIX')."center.cate_id = ".C('DB_PREFIX')."category.id","LEFT");
    $model->join(C('DB_PREFIX').'center_hits ON '.C('DB_PREFIX')."center.id = ".C('DB_PREFIX')."center_hits.center_id",'LEFT');
    $model->field(
            array(
            		C('DB_PREFIX').'center.*',
            		C('DB_PREFIX').'category.id',
            		C('DB_PREFIX').'center_hits.*',
            		C('DB_PREFIX').'category.name',
            		C('DB_PREFIX').'category.alias',
            		C('DB_PREFIX').'category.icon',
            		C('DB_PREFIX').'center.id' => 'cid'
            )
    );
    
    $map   =  array();
    $map[C('DB_PREFIX').'center.status'] = '1';
    if(is_int($where)){
    	if($where == 0) goto x;
        $map['cate_id'] = $where;
    }
    x :
    if (is_string($where)) {
    	$map['cate_id'] = getCategoryId($where);
    }
    if(is_int($limit) && is_int($offset)){
        $model->limit($offset,$limit);
    }elseif(is_int($limit)){
    	$model->limit($limit);
    }
    if($type == NULL){
    	$model->order('cid desc');
    }elseif($type == 'hit'){
    	$model->order(C('DB_PREFIX').'center_hits.hits desc');
    }else{
    	$map['type'] = $type;
    }
    $array = $model->where($map)->select();
	return $array;

}

function getCategoryId($alias){
    $model = M('category');
    $arr   = $model->field('id')->where( array('alias' => $alias ))->find();
    return $arr['id'];
}

function getCategory($val){
    $model = M('category');
    $map   = array();
    if(is_string($val)) $map['alias'] = $val;
    if(is_int($val))    $map['id']    = $val;
    $arr   = $model->field('id,parent_id,alias,name,url,view')->where( $map )->find();
    return $arr;
}

function getCategoryInfo($id,$limit = 10,$offset = NULL){
	$model = M('category');
	$data  = array();
	$cate  = $model->where( array('alias' => $alias ))->find();
	$map['cate_id'] = $cate['id'];
	$map['status']  = 1;
	if(is_int($limit)) $model->limit($offset,$limit);
	$data['list'] = $model->where($map)->order('id desc')->select();
	$data['info'] = $cate;
	return $data;
}

function getCategoryList($parent_id,$limit,$offset = NULL){
	if(!is_int($parent_id)) echo '未正确指定应用ID';
	$model = M('category');
	if(is_int($limit)) $model->limit($offset,$limit);

	$data = $model->where( array('parent_id' => $parent_id , 'status' => '1'))->select();
	return $data;
}

function getLinks($typeId = NULL,$limit = NULL,$offset = 0){
    $model = M('links');
    if(is_int($limit)) $model->limit($offset,$limit);
    if(is_int($typeId)) $map['sort'] = $typeId;
    $map['type'] = 1;
	return $model->where( $map )->select();
}

function getPictures($where,$limit,$offset = NULL){
	$model = M('album');
    $map   =  array();
    if(is_int($where)){
    	if($where == 0) goto x;
        $map['cate_id'] = $where;
    }
    x :
    if (is_string($where)) {
    	$map['cate_id'] = getCategoryId($where);
    }
    if(is_int($limit) && is_int($offset)){
        $model->limit($offset,$limit);
    }elseif(is_int($limit)){
    	$model->limit($limit);
    }
    $array = $model->where($map)->order('id desc')->select();
	return $array;
}

function siteTitle($key){
	$model = M('option');
	return $model->field('value')->where(array('key' => $key))->find();
}

//面包屑导航，把$_GET作为参数完全传入$id
function breadcrumbNavigation($id,$index = -1,$nav = array()){

    $index = $index + 1;

    if(!isset($id['id'])){
    	
    	if($index == 0){
    		$nav[$index] = getCategory(ACTION_NAME);
    	}else{
    		$nav[$index] = getCategory((int)$id['parent_id']);
    	} 
        	
    }else{
        $con = getContent($id['id']);
        $nav[$index] = getCategory((int)$con['cate_id']);
    }

    $id = $nav[$index];
                
    unset($id['id']);
    if($nav[$index]['parent_id'] != 0){
		return array_reverse(breadcrumbNavigation($id,$index,$nav));
	}	
    unset($nav[$index]);
	return array_reverse($nav);

}

//得到所有列表内容,支持两级
function getAllList($index = 6,$app = 1){
    
	$data  = array();
	$model = M('category');
	$data  = $model->where(array('parent_id' => $app, 'status'=>'1'))->select();
	$ca    = array();
	$cate_id  = array();
	foreach ($data as $key => $val){
		$ca[$val['id']] = array(
				'name' => $val['name'],
				'alias' => $val['alias']
		);
		$cate_id[$key][] = $val['id'];
		$list  = array();
		$list = M('center')->field('id,cate_id,thumb,title,create_time,update_time')->where(array('cate_id' => $val['id'],'status'=>'1'))->limit($index)->select();		
		$data[$key]['son'] = $cate = $model->where(array('parent_id' => $val['id'],'status'=>'1' ))->select();
		foreach ($cate as $k => $v){
			$ca[$v['id']] = array(
					'name' => $v['name'],
					'alias' => $v['alias']
			);
			$cate_id[$key][] = $v['id'];			
		}
		$cate_ids = implode(',', $cate_id[$key]);
		$map['status']  = '1';
		$map['cate_id'] = array('in',$cate_ids);

		$data[$key]['list'] = $list = M('center')->field('id,cate_id,thumb,title,create_time,update_time')->where($map)->limit($index)->select();

		foreach($list as $m => $n){
			$data[$key]['list'][$m]['cate'] = $ca[$list[$m]['cate_id']];				
		}

	}
	
	return $data;

}

//得到指定一篇内容
function getContent($id){

	$model = M('center');
    return $model->where(array('id' => $id, ))->find();

}

//相关内容
function contentAbout($limit){
	#todo
}

//上一条、下一条
function contentBoth($limit){
	#todo
}

//用户详情
function userInfo($uid){
	#todo
}

//指定用户下内容列表
function contentbyUserID($uid){
	#todo
}

//flase 为不带域名
function URL($alias,$id = NULL,$ym = true){
    $ym ? $ym = siteTitle('host_url') : $ym = '';
    if($id != NULL)
        return $ym.'/'.$alias.'/id_'.$id.'.html';
    else
        return $ym.'/'.$alias;
}

function nav($id = '0',$nav = array()){
	$nav = M("nav")->where(array('status'=>'1','parent_id'=>$id))->select();
	foreach ($nav as $key => $val){
		$nav[$key]['son'] = M("nav")->where(array('status'=>'1','parent_id'=>$val['id']))->select();
	}
	return $nav;
}