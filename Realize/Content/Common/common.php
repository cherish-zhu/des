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
    
    if($type == 'in:hit'){
    	$son  = M('category')->where( array('parent_id' => $where ))->select();
    	foreach ($son as $key => $val){
    		$ids[] = $val['id'];
    	}
    	$id = implode(',', $ids);
    	$map['cate_id'] = array('in',$id);
    	$type = 'hit';
    	$where = NULL;
    }

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
    $arr   = $model->field('id,parent_id,alias,name,url,app,view')->where( $map )->find();
    return $arr;
}

function getCategoryInfo($id,$limit = 10,$offset = NULL){
	$model = M('category');
	$center = M('center');
	$data  = array();
	$cate  = $model->where( array('id' => $id ))->find();
	$son  = $model->where( array('parent_id' => $cate['id'] ))->select();
	foreach ($son as $key => $val){
		$ids[] = $val['id'];
	}
	$id = implode(',', $ids);
	$map['cate_id'] = array('in',$id);
	$map[C('DB_PREFIX').'center.status']  = '1';
	$center->join(C('DB_PREFIX')."category ON ".C('DB_PREFIX')."center.cate_id = ".C('DB_PREFIX')."category.id","LEFT");
	$center->field(
			array(
					C('DB_PREFIX').'center.*',
					C('DB_PREFIX').'category.name',
					C('DB_PREFIX').'category.alias',
					C('DB_PREFIX').'category.icon',
					C('DB_PREFIX').'category.id' => 'cid'
			)
	);
	if(is_int($limit))$center->limit($offset,$limit);
	$data['list'] = $center->where($map)->order(C('DB_PREFIX').'center.id desc')->select();
	$data['info'] = $cate;
	$data['son'] = $son;
	return $data;
}

function getCategoryList($parent_id,$limit,$offset = NULL){
	if(!is_int($parent_id)) echo '未正确指定应用ID';
	$model = M('category');
	if(is_int($limit)) $model->limit($offset,$limit);

	$data = $model->where( array('parent_id' => $parent_id , 'status' => '1'))->select();
	return $data;
}

function getCategoryAll($parent_id,$limit,$offset = NULL,$nums = 3){
    
	$model = M('category');
	if(is_int($limit)) $model->limit($offset,$limit);

	$data = $model->where( array('parent_id' => $parent_id , 'status' => '1'))->select();
	
	foreach ($data as $key => $val){
		$data[$key]['son'] = $model->where( array('parent_id' => $val['id'] , 'status' => '1'))->limit($nums)->select();
	}
	
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
		$data[$key]['son'] = $cate = $model->where(array('parent_id' => $val['id'],'status'=>'1' ))->limit(10)->select();
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
    return $model->where(array('id' => $id))->find();

}

//相关内容
function contentAbout($cate_id,$limit = 5){
    $model = M('center');
    $model->field('id,title,create_time');
    $model->where(array('cate_id'=>$cate_id,'status'=>'1'));
	$arr = $model->limit($limit)->order('rand()')->select();
    return $arr;
}

//上一条、下一条
function contentBoth($id,$category = false){
	$model = M('center');
    $model->field('id,title');
    $map['id'] = array('gt',(int)$id);
    $where['id'] = array('lt',(int)$id);
    $map['status'] = $where['status'] = '1';
    if($category != false) $map['cate_id'] = $where['cate_id'] = $category;
    $pre = $model->where($map)->order('id ASC')->find();
    $next = $model->where($where)->order('id DESC')->find();
    if(empty($pre)) $pre = array('id'=>0,'title'=>'没有了');
    if(empty($next)) $next = array('id'=>0,'title'=>'没有了');
    return array(
        'pre'  => $pre,
        'next' => $next
    );
}

//用户详情
function userInfo($uid){
	$model = M('user');
    $model->join(C('DB_PREFIX')."user_communication ON ".C('DB_PREFIX')."user_communication.uid = ".C('DB_PREFIX')."user.id","LEFT")
          ->join(C('DB_PREFIX')."user_list ON ".C('DB_PREFIX')."user.id = ".C('DB_PREFIX')."user_list.uid","LEFT")
          ->join(C('DB_PREFIX')."user_level ON ".C('DB_PREFIX')."user.id = ".C('DB_PREFIX')."user_level.uid","LEFT");
    $model->field(
            array(
                    C('DB_PREFIX').'user.id',
                    C('DB_PREFIX').'user.number',
                    C('DB_PREFIX').'user.account',
                    C('DB_PREFIX').'user.face',
                    C('DB_PREFIX').'user.nickname',
                    C('DB_PREFIX').'user.phone',
                    C('DB_PREFIX').'user.last_login_time',
                    C('DB_PREFIX').'user.last_login_ip',
                    C('DB_PREFIX').'user.email',
                    C('DB_PREFIX').'user.create_time',
                    C('DB_PREFIX').'user.status',
                    C('DB_PREFIX').'user_level.*',
                    C('DB_PREFIX').'user_list.*',
                    // C('DB_PREFIX').'center.id' => 'cid'
            )
        );
    $userInfo = $model->where(array('id'=>$uid))->find();
    return $userInfo;
}

//用户
function userName($uid){
    $user = M('user')->field('nickname')->where(array('id'=>$uid))->find();
    return $user['nickname'];
}

//指定用户下内容列表
function contentbyUserID($uid){
	$model = M('center');
    $model->join(C('DB_PREFIX')."center_count ON ".C('DB_PREFIX')."center_count.center_id = ".C('DB_PREFIX')."center.id","LEFT")
          ->join(C('DB_PREFIX')."center_hits ON ".C('DB_PREFIX')."center.id = ".C('DB_PREFIX')."center_hits.center_id","LEFT")
          ->join(C('DB_PREFIX')."category ON ".C('DB_PREFIX')."center.cate_id = ".C('DB_PREFIX')."category.id","LEFT");
    $model->field(
            array(
                    C('DB_PREFIX').'center.*',
                    C('DB_PREFIX').'center_count.*',
                    C('DB_PREFIX').'center_hits.*',
                    C('DB_PREFIX').'category.id',
                    C('DB_PREFIX').'category.name',
                    C('DB_PREFIX').'category.alias',
                    C('DB_PREFIX').'category.icon',
                    C('DB_PREFIX').'category.id' => 'cid'
            )
        );
    $list = $model->where(array('user_id'=>$uid,'status'=>1))->select();
    return $list;
}

//flase 为不带域名
function URL($alias,$id = NULL,$ym = true,$hz = '.html'){
    $host = siteTitle('host_url');
    $ym ? $ym = $host['value'] : $ym = '';
    if($id != NULL)
        return $ym.'/'.$alias.'/'.$id.$hz;
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

function tags(){
    #todo
}

function albums($cate = NULL,$type = 0,$limit = 10){//是否指定分类，默认全局不指定分类，0：最新排序，1热度排序
	$model = M('category');
	$map = array();
	$map['status'] = '1';
	$map['app'] = '0';	
	if($cate != NULL) $map['parent_id'] = $cate;
	$model->where($map);
	if($type == 0) $model->order('id DESC');
	if($type == 1) $model->order('hits DESC');
	$albums = $model->limit($limit)->select();
	foreach ($albums as $key => $val){
		$albums[$key]['parent'] = getCategory((int)$val['parent_id']);
	}
	return $albums;
}

function album($id){

}

//相关内容
function albumAbout($cate_id,$limit = 5){
	$model = M('category');
	$model->field('id,name,alias,icon')->where(array('parent_id'=>$cate_id,'status'=>'1'));
	$arr = $model->limit($limit)->order('rand()')->select();
	return $arr;
}

//上一条、下一条
function albumBoth($id,$category = false){
	$model = M('category');
	//$model;
	$map['id'] = array('gt',$id);
	$where['id'] = array('lt',$id);
	$map['status'] = $where['status'] = '1';
	if($category != false) $map['parent_id'] = $where['parent_id'] = $category;
	$pre = $model->field('id,name,alias')->where($map)->order('id ASC')->find();
	$next = $model->field('id,name,alias')->where($where)->order('id DESC')->find();
	if(empty($pre)) $pre = array('id'=>0,'title'=>'没有了');
	if(empty($next)) $next = array('id'=>0,'title'=>'没有了');
	return array(
			'pre'  => $pre,
			'next' => $next
	);
}