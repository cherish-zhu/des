<?php
namespace Admin\Controller;

class menuController extends CommonController {
	
/**
     * 菜单列表
     * 默认列出为一级菜单，通过传入父级id进入子菜单列表
     * @param int $parent_id
     */
    public function index($menuid = NULL){
       $menuid == 8 && $menuid = 0;
       $this->assign("menu",D("AdminMenu")->adminMenu($menuid));
       $this->assign('menus',array('A'=>'常用','B'=>'菜单管理'));
       $this->display();
    }
    
    /**
     * 添加菜单
     * 
     * @return string
     */
    public function addMenu(){
        $model = D("menu");
        $_POST['pid'] = intval($_POST['pid'] == 8 ? $_POST['pid'] = 0 :$_POST['pid']);
        $_POST['app']  = 'admin';
        $_POST['status']  = 1;
        
        if($model->create()){
            if($model->add()){
                $this->success("操作成功");
            }else{
                $this->error($model->getDbError());
            }
        }else{
            $this->error($model->getError());
        }
    }
    
    //禁用，修改状态
    public function menuStatus(){
       $model = M("menu");
       $model->status = $_GET['status'] == 1 ? 0 :1;
       $model->where(array('id'=>$_GET['id']));
       
       if($model->save()){
           $this->success("操作成功");
       }else{
           $this->error($model->getDbError());
       }
    }
    
    //添加菜单页面渲染
    public function addFrom(){
        $this->assign('menus',array('A'=>'常用','B'=>'添加菜单'));
        $this->display();
    }
    
    //编辑菜单
    public function edit(){

        $id = $_GET['id'];//I('id');
        $this->assign('menus',array('A'=>'常用','B'=>'编辑菜单'));
        if(IS_POST){          

            $Menu = D("menu");
            $data = array(
                'name' => $_POST['name'],
                'controller' => $_POST['controller'],
                'action'    => $_POST['action'],
                'icon'     => $_POST['icon']
            );

            $update =  $Menu->where(array('id'=>$id))->save($data);

            if($update!== false){
//                    session('ADMIN_MENU_LIST',null);
//                    //记录行为
//                    $this->addLog('编辑菜单',1,NULL);
//                    action_log('update_menu', 'AdminMenu', $data['id'], UID);
                   $this->success('更新成功', Cookie('__forward__'));
            } else {
                    $this->error($Menu->getError());
            }

        } else {

            $info = array();
            /* 获取数据 */
            $model =  M('menu');
            $info = $model->field(true)->where(array('id'=>$id))->find();

            $this->assign("info",$info);

            $this->display();
        }
       
    }
    
}