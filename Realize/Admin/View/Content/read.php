<!DOCTYPE html>
<html>
<head>
<title>文章内容 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/index.css" />
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
<style type="text/css">
.word-box{width:auto; height:auto; clear:both; margin-top:20px}
.word-line{width:auto; height:auto; border-bottom:#CCC 1px dashed; margin-bottom:12px; padding-bottom:16px}
.word-title{float:left; text-indent:2em;  font-weight:bold; line-height:36px}
.word-site{float: right; font-size:12px;line-height:36px}
.word-center{ clear:both; text-indent:2em; line-height:36px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
.word-map{clear:both;text-indent:2em; height:20px; line-height:20px; width:100%}
.word-map a{float:left; margin-right:10px; font-size:13px; line-height:32px}
</style>
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

              <input name="user" type="text" id="textfield" size="20" placeholder="请输入用户名" />

              <input type="text" name="textfield2" id="textfield2" placeholder="请输入关键词"  />
              <input type="submit" name="button" class="smile-butt" value="查找" />
            </form>
          </div>
         
          <div class="setect-right"><div class="setting"><i class="fa fa-cog"></i>  设置</div></div>
          <div class="setect-right"><a href="/admin/content/write"><div class="setting" style="margin-right: 12px; width:100px !important"><i class="fa fa-pencil"></i>  新增内容</div></a></div>
     </div>

          <div class="word-box">

               <?php foreach($center as $k => $v){?>
               <div class="word-line" id="line-<?php echo $v['id']?>">
                    <div class="word-title"><?php echo $v['title']?></div>
                    <div class="word-site"><?php echo $v['user_id']?>  <?php echo date('Y-m-d H:m:s',$v['create_time'])?> 发表在 <?php echo $v['sort']?></div>
                    <div class="word-center"><?php echo msubstr(strip_tags($v['center']), $start=0, 100, "utf-8", true)?></div>
                    <div class="word-map"><a href="/admin/content/edit?id=<?php echo $v['id']?>" class="edit">编辑</a><a href="javascript:viod(0)" class="delete" id="del-<?php echo $v['id']?>">删除</a><a href="#">移动</a><a href="#">预览</a><a href="#">评论</a><a href="#">审核</a></div>
               </div>
               <?php }?>
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
$(".word-map").hide();
$(".word-line").hover(function(){
	$(".word-map").hide();
	$(this).find(".word-map").show();
});

$(".delete").click(function(){
	
	$id = $(this).attr("id");
	$id = $id.split("-");
	$id = $id[1];
	$.get("/admin/content/delete/id/"+$id,function(data){
		$("#line-"+$id).remove();
		alert(data.msg);
	},"json");
	
});

</script>
</html>