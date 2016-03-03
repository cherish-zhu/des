<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Destroy</title>
<style type="text/css">
*{padding:0; margin:0 auto}
body{background-image:url(/Static/background/bg2.jpg);background-size:100%; text-align:center; padding-top:100px}
</style>
</head>

<body>
<table width="960" height="36" border="0" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
  <tr>
    <?php foreach(breadcrumbNavigation($_GET) as $ke => $va){?>
    <td>&nbsp;&nbsp;&nbsp;<a href="<?php echo $va['links']?>"><?php echo $va['name']?></a>  > </td>
    <?php }?>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="960" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="36" colspan="2" bgcolor="#FFFFFF">&nbsp;&nbsp;<a href="#"><?php echo $cate_info['name']?></a></td>
    <td width="16" rowspan="7" >&nbsp;</td>
    <td width="251" rowspan="7" valign="top" style="vertical-align:top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="36" bgcolor="#FFFFFF">&nbsp;文章分类</td>
      </tr>
      <?php foreach(getCategoryList(1,6) as $get => $li){?>
      <tr>
        <td height="36" bgcolor="#FFFFFF">&nbsp;&nbsp;<a href="<?php echo URL($li['alias'])?>"><?php echo $li['name']?></a></td>
      </tr>
      <?php }?>
    </table></td>   
  </tr>
  <?php foreach($arr as $new => $ne){?>
  <tr>
    <td width="498" height="36" bgcolor="#FFFFFF">&nbsp;&nbsp;<a href="<?php echo URL($ne['alias'],$ne['cid'])?>"><?php echo $ne['title']?></a></td>
    <td width="195" bgcolor="#FFFFFF"><?php echo date("Y-m-d H:i",$ne['create_time']);?></td>
  </tr>
  <?php }?>
  <tr>
    <td width="498" height="36" bgcolor="#FFFFFF">&nbsp;&nbsp;<?php echo $page?></td>
    <td width="195" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="36" bgcolor="#FFFFFF">&nbsp;&nbsp;友情链接</td>
  </tr>
  <tr>
    <td height="50" bgcolor="#FFFFFF"><?php foreach(getLinks() as $link => $s){
		echo '<a style="margin-right:30px; margin-left:20px;" href="#'.$s['link'].'">'.$s['name'].'</a>';
	}
	?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
