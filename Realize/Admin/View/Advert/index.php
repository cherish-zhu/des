<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的控制台</title>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/index.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/list.css" />
<?php require_once('./Realize/Admin/View/Public/top.php');?>


<div class="main">

<?php require_once('./Realize/Admin/View/left/leftSystem.php');?>

<div class="right">
    
    <div class="ul">
         <div class="ul-line">
              <div class="ul-box"><div class="ul-title">广告文字：</div><div>这是一个示例广告</div></div>
              <div class="ul-box"><div class="ul-title">广告代码：</div><div>{text:14338878-01}</div></div>
              <div class="ul-action"><a href="#">编辑</a> <a href="#">删除</a></div>
         </div>
         <div class="ul-content"></div>
    </div>
    
    <div class="ul">
         <div class="ul-line">
              <div class="ul-box"><div class="ul-title">广告文字：</div><div>这是一个示例广告</div></div>
              <div class="ul-box"><div class="ul-title">广告代码：</div><div>{image:14338878-01}</div></div>
              <div class="ul-action"><a href="#">编辑</a> <a href="#">删除</a></div>
         </div>
         <div class="ul-content"><img src="/Data/face/20150308175559.png" width="1000" height="90" /></div>
    </div>
    
</div>

</div>

<script type="text/javascript">
$("#select").live("change",function(){
	cid = $(this).val();
	$.get(baseURL+"/album/lib?cid="+cid,function(r){
		
		var str = '<span style="float:left; line-height:50px; margin-right:30px"><<</span>';
		$.each(r,function(i,e){
			if(i==0){
				$(".aid").attr("id",e.cid);//选择分类时设置第个相册为默认操作
			}
			str+='<p><a href="javascript:album('+e.cid+')">'+e.class_name+'</a></p>';
		});
		str+='<span style="line-height:50px;">>></span>';
		alert(str)
		$(".img-right").html(str);
	},'json');
});
$(".check-img").live("click",function(){
	$(".img").each(function(){
		if($(this).attr("class")=="img img-border"){
			var imgSRC = $(this).children("img").attr("src");
			$("#change-ico").html('<img src="'+imgSRC+'" />');
			$("#ico").val(imgSRC);
		}
	});
	art.dialog({id: 'ND1539'}).close();
});

</script>
<?php require_once('./Realize/Admin/View/Public/footer.php');?>