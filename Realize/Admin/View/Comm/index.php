<!DOCTYPE html>
<html>
<head>
<title>系统首页 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/app.css" />
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
                <option value="0">请选择应用</option>
              </select>

              <input name="user" type="text" id="textfield" size="20" placeholder="请输入用户名" />

              <input type="text" name="textfield2" id="textfield2" placeholder="请输入关键词"  />
              <input type="submit" name="button" class="smile-butt" value="查找" />
            </form>
          </div>
           <div class="setect-right"><div class="setting"><i class="fa fa-cog"></i>  设置</div></div>
    </div>
     
     <div class="appmain" style="margin-top:0px !important">
     <table width="100%" border="0" bgcolor="#999999" cellpadding="0" cellspacing="0">
       <tr>
            <td width="6" height="36">&nbsp;</td>
            <td width="15">ID</td>
            <td width="30" height="36"><input type="checkbox" name="CheckboxGroup1" value="复选框"  class="checkAll" id="CheckboxGroup1_0"  /></td>
            <td width="98">用户</td>
            <td width="232">内容</td>
            <td width="542">&nbsp;</td>
            <td width="126">发布时间</td>
            <td width="50">状态</td>
          </tr>
     </table>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0" id="commList">
       <?php 
			    if(isset($comm))
				foreach($comm as $k=>$v){
		?>
          <tr id="<?php echo $v['comm_id']?>">
            <td width="6" height="36">&nbsp;</td>
            <td width="15"><?php echo $v['comm_id']?></td>
            <td width="30" height="36"><input type="checkbox" name="CheckboxGroup1" value="复选框" id="CheckboxGroup1_0"  /></td>
            <td width="98">user</td>
            <td width="232"><?php echo $v['comm']?></td>
            <td width="542">&nbsp;</td>
            <td width="126"><?php echo $v['ctime']?></td>
            <td width="50"><?php if($v['status']=='1'){echo "已审核";}elseif($v['status']=='0'){echo '<font color="red">未审核</font>';}?></td>
          </tr>
       <?php }?>            
       </table>
       <div class="page">
	       <div class="pageLeft">
	         <table width="344" border="1" align="left">
	           <tr>
	             <td width="35"><div class="action checkAll">全选</div></td>
	             <td width="35"><div class="action" id="checkBack">反选</div></td>
	             <td width="185">
	                 <div style="float:left" class="action">删除</div> <div  style="float:left"  class="action">审核</div>    
                  </td>
	             <td width="61">&nbsp;</td>
               </tr>
             </table>
	       </div>
         <div class="pageRight"><?php echo $page?></div>
       </div>
     </form>
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
<script type="text/javascript">
$(function(){
     $("#commList tr:even").css("background-color","#DFDFDF");
     $("#commList tr").hover(function(){
	       $(this).addClass("trhover");
		   $(this).attr("title","双击删除");
     }, function(){
	       $(this).removeClass("trhover");
		   $(this).attr("title").remove();
     });
     $("#commList tr").each(function(i,n){
	 	   $(this).dblclick(function(){
		         art.dialog.confirm('你确定要删除吗？', function () {
					  n.remove();
                      art.dialog.tips('删除成功');
                 }, function () {
                      art.dialog.tips('执行取消操作');
                 });
	       });
     });	 
});
</script>
</html>