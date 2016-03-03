<!DOCTYPE html>
<html>
<head>
<title>图片相册 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<meta HTTP-EQUIV="pragma" CONTENT="no-cache">  
<meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">  
<meta HTTP-EQUIV="expires" CONTENT="0"> 
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
<link rel="stylesheet" type="text/css" href="/Static/uploadify/uploadify.css">
<link rel="stylesheet" type="text/css" href="/Static/admin/css/album.css">
<link rel="stylesheet" type="text/css" href="/Static/admin/css/style.min.css">
<link rel="stylesheet" type="text/css" href="/Static/admin/css/font.min.css">
<style type="text/css">
#uploadify{margin-top:-10px}
</style>
</head>

<body>
    <div id="wrapper">
<?php require_once('./Realize/Admin/View/Public/left.php');?>


        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php require_once('./Realize/Admin/View/Public/top.php');?>
            <div class="wrapper wrapper-content">
            
                 <div class="album" style="height: auto">
          <ul style="width:830px; height:40px; float:left">
              <li style="float:left"><?php echo !empty($album['name']) ? $album['name'] : '相册列表'?></li>
              <li style="float:right"><span id="uploadify"></span></li>
          </ul>
          <ul class="ace-thumbnails" id="fileQueue" style="width:830px; float:left">
          <?php foreach($pic as $p => $s){?>
           <li class="pic_box">
				<a href="#" data-rel="colorbox">
												<img class="pic_list" src="<?php echo $s['path']?>" />
												<div class="text">
													<div class="inner"><?php echo $s['title']?></div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="javascript:viod(0)" id="edi-<?php echo $s['id']?>"><i class="fa fa-pencil"  id="id-<?php echo $s['cate_id']?>"></i></a>
												<a href="javascript:viod(0)" id="del-<?php echo $s['id']?>"><i class="fa fa-remove red"></i></a>
											</div>
				</li>
                <?php }?>
                <div style="width: 100%; height:1px; clear:both"></div>
                </ul>
      
       
      
           <div class="album-type" style="margin-top:-40px">
                
                 <?php foreach($option as $key => $val){?>
                 <dl  <?php if($_GET['category'] == $val['id']) echo 'class="album-type-dt"';?>>
                     <dt><a href="?category=<?php echo $val['id']?>"><?php echo $val['name']?></a></dt>
                     <?php foreach($val['son'] as $k => $v){?>
                     <dd><a href="?category=<?php echo $val['id']?>&album=<?php echo $v['id']?>"><?php echo $v['name']?></a></dd>
                     <?php }?>
                 </dl>
                 <?php }?>
           </div> 
             
           <div class="page" style="margin-top:30px; float:left; width:81%; ">
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
                        
      <div id='album_id' style="display:none"><?php echo $_GET['album'] ? $_GET['album'] : $_GET['category'];?></div>     
      <div style="width: 100%; height:20px; clear:both"></div>
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
<script src="/Static/uploadify/jquery.uploadify.min.js?ver=<?php echo rand(0,9999);?>" type="text/javascript"></script>
<script src="/Static/admin/js/album.js" type="text/javascript"></script>
<script src="/Static/admin/js/upload.js" type="text/javascript"></script>
</html>