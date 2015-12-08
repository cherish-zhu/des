<!DOCTYPE html>
<html>
<head>
<title>友情链接 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/index.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/link.css" />
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
                <option value="0">请选择分类</option>
              </select>
              <input name="link" type="text" id="textfield" size="20" placeholder="请输入关键字" />
              <input type="submit" name="button" class="smile-butt" value="查找" />
            </form>
          </div>
          <div class="setect-right"><a href="/admin/links/add?app=3" style="color:#FFF"><div class="setting"><i class="fa fa-cog"></i> &nbsp; 添加</div></a></div>
     </div>
      
      <div class="face">
           <div class="link-list">
             <form id="form1" name="form1" method="post" action="">
             <ul>
              <li class="link-mian">
                   <div class="link-check">
                       <input type="checkbox" name="checkbox" id="checkbox" />
                   </div>
                   <div class="link-id">名称</div>
                   <div class="link-name">链接地址</div>
                   <div class="link-action">操作</div>
                   <div class="link-from">所属分类</div>                 
               </li>
                <?php foreach($link as $k => $u){?>
                <li id="link-<?php echo $u['id']?>">    
                   <div class="link-check">
                       <input type="checkbox" name="checkbox" id="checkbox" />
                   </div>
                   <div class="link-id"><?php echo $u['name']?></div>
                   <div class="link-name"><?php echo $u['link']?></div>
                   <div class="link-action"><a href="<?php echo $u['link']?>" target="_blank"><i class="fa fa-eye" title="查看详情"></i></a><i link-id="<?php echo $u['id']?>" class="fa fa-times delete_link" title="删除用户"></i></div>
                   <div class="link-from"><?php echo $u['sort']?></div>              
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
	$(".delete_link").click(function(){
		$id = $(this).attr("link-id");
		art.dialog.confirm('您确定要删除吗？', function () {
			$.get("/admin/links/delete?id="+$id,function(data){
				if(data.status == 1){
					art.dialog.tips('删除成功');
					$("#link-"+$id).remove();
				}else{
					art.dialog.tips('删除失败');
				}
		    },"json");
        }, function () {
               art.dialog.tips('执行取消删除');
        });
	});
});
</script>
</html>