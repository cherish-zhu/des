<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的控制台</title>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/index.css" />
<?php require_once('/Realize/Admin/View/public/top.php');?>

 <div class="main">

<?php require_once('/Realize/Admin/View/left/leftDevelop.php');?>

<div class="right"  style="background-color:#FFF">
     
     <div class="menu">
          <ul>
            <li><a href="<?php echo url2("/tools/myTools")?>">我的工具</a></li>
            <li><a href="<?php echo url2("/tools")?>">工具中心</a></li>
          </ul>
      </div>

</div>
<?php require_once('/Realize/Admin/View/Public/footer.php');?>