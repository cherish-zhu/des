<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的控制台</title>
<style type="text/css">
.changge-album{width:760px; height:40px; line-height:40px; vertical-align: middle}
.album-list{width:760px; height:650px}
.ajax-page{width:640px; height:40px; float:left; list-style-type:none}
.get-url{float:left; width:80px;  cursor:pointer; background-color:#093; color:#FFF; height:40px; line-height:40px; text-align:center}
.image-check{float:left; width:114px; height:140px; margin-right:12px; margin-bottom:12px; cursor:pointer; background-color:#FFF}
.image-check img{width:110px; height:110px}
.image-title{width:110px; height:30px; text-align: center; line-height:30px; overflow:hidden}
.ajax-page li{float:left; margin-right:12px; height:26px; font-size:13px; text-align:center; cursor:pointer; line-height:26px; padding-left:10px; padding-right:10px}
.page-back{background-color:#0C9; color:#FFF}
.img-border{border:2px solid #093}
</style>
</head>

<body>
<div class="changge-album">
  <label for="select">选择相册</label>
  <select name="select" id="select-img">
    <?php  foreach($option as $k=>$v){?>
             <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>              <?php  foreach($v['son'] as $key=>$sc){?>
             <option value="<?php echo $sc['id']?>">&nbsp;&nbsp;&nbsp;<?php echo $sc['name']?></option>
             <?php }?>
	 <?php }?>
  </select>
</div>
<div class="album-list">
     <?php foreach($list as $key => $val){?>
     <div class="image-check"><img src="<?php echo $val['path']?>" width="37" height="50" /><div class="image-title"><?php echo $val['title']?></div></div>
	 <?php }?>
</div>
<ul class="ajax-page">
</ul><div class="get-url">确定</div>
<input type="hidden" name="hiddenField" id="page" value="1" />
<input type="hidden" name="hiddenField" id="count" value="<?php echo $count?>" />
<input type="hidden" name="hiddenField" id="cate" value="<?php echo $cate?>" />
</body>
<script type="text/dialog">
$(".image-check").live("click",function(){
		if($(this).hasClass("img-border") == false){
			$(".img-border").removeClass("img-border");
			$(this).addClass("img-border");
		}else{
			$(this).removeClass("img-border");
		}
});
$("#select-img").change(function(){
	$(".album-list").html('');
	cate_id = $(this).val();
	$("#cate").val($(this).val());
		$(".ajax-page").html('');
	$(".ajax-page").html('<li class="page-back" id="up-1">上一页</li><li  class="page-back" id="page-1">1</li><li id="page-2">2</li><li id="page-3">3</li><li id="page-4">4</li><li id="page-5">5</li><li id="page-6">6</li><li id="page-7">7</li><li  class="page-back"  id="down-1">下一页</li>');
	$.get("/admin/Album/change_img?_ajaxs=1&cate_id="+cate_id,function(ret){
		$("#count").val(ret.count);
		er = ''
		$.each(ret.data,function(e,s){
			er += '<div class="image-check"><img src="'+s.path+'" width="37" height="50" /><div class="image-title">'+s.title+'</div></div>';			
		});
		$(".album-list").html(er);
	},"json");
});
$(".ajax-page").html('<li class="page-back" id="up-1">上一页</li><li  class="page-back" id="page-1">1</li><li id="page-2">2</li><li id="page-3">3</li><li id="page-4">4</li><li id="page-5">5</li><li id="page-6">6</li><li id="page-7">7</li><li  class="page-back"  id="down-1">下一页</li>');

$(".ajax-page li").live("click",function(){
	id = $(this).attr("id");
	id = ud = id.split("-");
	id = id[1];
	page = parseInt($("#page").val());
	count = $("#count").val();
	count = Math.ceil(count/24);
	cate_id = $("#cate").val();
	if(ud[0] == 'up') id = page - 1;
	if(ud[0] == 'down') id = page + 1;
	if(id <= 1) id = 1;
	if(id >= count) id = count;
	str = '<li class="page-back" id="up-'+id+'">上一页</li>';
	if(id <= 3){
	for(var i=1;i<=7;i++){
		if( i == id) str += '<li class="page-back" id="page-'+i+'">'+i+'</li>';
		else str += '<li id="page-'+i+'">'+i+'</li>';	
	}	
	}else if(count<7){
		for(var i=1;i<=count;i++){
		    if( i == id) str += '<li class="page-back" id="page-'+i+'">'+i+'</li>';
			else str += '<li id="page-'+i+'">'+i+'</li>';		
	    }
	}else if(id >= count-3 && count>7){
		for(var i=count - 6;i<=count;i++){
		    if( i == id) str += '<li class="page-back" id="page-'+i+'">'+i+'</li>';
			else str += '<li id="page-'+i+'">'+i+'</li>';		
	    }
	}else if(id >=3 && id <= count-3){
		for(var i=id - 3;i<=id +3;i++){
			if( i == id) str += '<li class="page-back" id="page-'+i+'">'+i+'</li>';
			else str += '<li id="page-'+i+'">'+i+'</li>';		
	    }
	}
	str += '<li class="page-back" id="down-'+id+'">下一页</li>';
	$(".ajax-page").html('');
	$(".ajax-page").html(str);
	$("#page").val(id);
	str = '';
	$.get("/admin/Album/change_img?_ajaxs=1&cate_id="+cate_id+'&page='+id,function(ret){
		er = ''
		$.each(ret.data,function(e,s){
			er += '<div class="image-check"><img src="'+s.path+'" width="37" height="50" /><div class="image-title">'+s.title+'</div></div>';			
		});
		$(".album-list").html(er);
	},"json");
});
$(".get-url").click(function(){
	if($(".image-check").hasClass("img-border") == false){
		alert("请选择图片");
		return false;
	}
	src = $(".img-border img").attr("src");
	$(".cont-img").html("");
	$(".cont-img").html("<img src="+src+" />");
	$("#thumb").val(src);
	//$("#N3690").close();
	art.dialog({id:'N35891'}).close();
});
</script>
</html>