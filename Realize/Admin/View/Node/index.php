<!DOCTYPE html>
<html>
<head>
<title>用户权限 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/index.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/user.css" />
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
<link href="/Static/css/plugins/iCheck/custom.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
<?php require_once('./Realize/Admin/View/Public/left.php');?>


        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php require_once('./Realize/Admin/View/Public/top.php');?>
            <div class="wrapper wrapper-content">
            
<div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>节点管理</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_basic.html#">选项1</a>
                                </li>
                                <li><a href="table_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-5 m-b-xs">
                                <a href="/admin/Node/add" type="button" class="btn btn-sm btn-primary">添加主节点</a>
                                <!--select class="input-sm form-control input-s-sm inline">
                                    <option value="0">请选择</option>
                                    <option value="1">选项1</option>
                                    <option value="2">选项2</option>
                                    <option value="3">选项3</option>
                                </select-->
                            </div>
                            <div class="col-sm-4 m-b-xs">
                                <div data-toggle="buttons" class="btn-group">
                                    <!--label class="btn btn-sm btn-white">
                                        <input type="radio" id="option1" name="options">天</label>
                                    <label class="btn btn-sm btn-white active">
                                        <input type="radio" id="option2" name="options">周</label>
                                    <label class="btn btn-sm btn-white">
                                        <input type="radio" id="option3" name="options">月</label-->
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <!--input type="text" placeholder="请输入关键词" class="input-sm form-control"> <span class="input-group-btn"-->
                                         </span>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>  
                                        <th></th>
                                        <th>节点名称</th>
                                        <th>Controller</th>
                                        <th>action</th>
                                        <th>查看子节点</th>
                                        <th>状态</th>
                                        <th style="float:right; width:200px">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($nodes as $key => $val){?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" checked class="i-checks" name="input[]">
                                        </td>
                                        <td><a href="" style="line-height:50px"><?php echo $val['title']?></a></td>
                                        <td><span class="pie"><?php echo $val['Controller']?></span>
                                        </td>
                                        <td><?php echo $val['action']?></td>
                                        <th><a href="" style="line-height:50px">查看子节点</a></th>
                                        <td>正常</td>
                                        <td style="float:right; width:200px"><a href="/admin/Node/add?fid=<?php echo $val['id']?>" class="btn btn-sm btn-primary">新增子节点</a> <a href="/admin/Node/edit?id=<?php echo $val['id']?>" class="btn btn-sm btn-primary">编辑</a> <a href="/admin/Node/del?id=<?php echo $val['id']?>" class="btn btn-sm btn-primary">删除</a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
     
     </div>


                
            <div class="footer">
                <div class="pull-right">
                    By：<a href="http://www.destroy.net.cn/" target="_blank">destroy.net.cn</a>
                </div>
                <div>
                    <strong>Copyright</strong> Destroy &copy; 2015
                </div>
            </div>
        </div>
    </div>


</body>
<script src="/Static/js/plugins/iCheck/icheck.min.js"></script>
</html>