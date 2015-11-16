<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<title>系统首页 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/index.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/user.css" />
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
</head>

<body>
    <div id="wrapper">
<?php require_once('./Realize/Admin/View/Public/left.php');?>


        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php require_once('./Realize/Admin/View/Public/top.php');?>
            <div class="wrapper wrapper-content">
            


 <div class="select">
          <div class="select-left">
            <form id="form2" name="form2" method="post" action="">
              <select name="select2" id="select2">
                <option value="0">请选择用户组</option>
              </select>
              <input name="user" type="text" id="textfield" size="20" placeholder="请输入用户名" />
              <input type="submit" name="button" class="smile-butt" value="查找" />
            </form>
          </div>
          <div class="setect-right"><div class="setting"><i class="fa fa-cog"></i>  设置</div></div>
     </div>
      
      <div class="face">
           <div class="user-list">
             <form id="form1" name="form1" method="post" action="">
             <ul>
              <li class="user-mian">
                   <div class="user-check">
                       <input type="checkbox" name="checkbox" id="checkbox" />
                   </div>
                   <div class="user-id">用户ID</div>
                   <div class="user-name">用户名</div>
                   <div class="user-action">操作</div>
                   <div class="user-time">注册时间</div>
                   <div class="user-from">最近登录</div>                 
               </li>
                <?php foreach($users as $k => $u){?>
                <li>    
                   <div class="user-check">
                       <input type="checkbox" name="checkbox" id="checkbox" />
                   </div>
                   <div class="user-id"><?php echo $u['id']?></div>
                   <div class="user-name"><?php echo $u['account']?></div>
                   <div class="user-action"><i class="fa fa-eye" title="查看详情"></i><i class="fa fa-times" title="删除用户"></i></div>
                   <div class="user-time"><?php echo date("Y-m-d H:i:m",$u['create_time'])?></div>
                   <div class="user-from"><?php echo $u['last_login_ip']?></div>              
                </li>
				<?php }?>
             </ul>
             </form>
           </div>
           
            <div class="page">
	       <div class="pageLeft">
	         <table width="200" border="0" align="left" cellpadding="0" cellspacing="0">
	           <tr>
	             <td width="31"><font id="checkAll">全选</font></td>
	             <td width="30"><font id="checkBack">反选</font></td>
	             <td width="104">
	               <select name="select" size="1" id="select">
	                 <option value="1">删除</option>
	                 <option value="2">审核</option>
                 </select></td>
	             <td width="7">&nbsp;</td>
               </tr>
             </table>
	       </div>
         <div class="pageRight"><?php echo $page?></div>
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

</html>