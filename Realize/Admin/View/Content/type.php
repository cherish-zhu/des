<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文章内容 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/top.php');?>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/type.css" />

<div class="main">

<?php require_once('./Realize/Admin/View/left/leftAppliance.php');?>

<div class="right"  style="background-color:#FFF">

<ul class="sortable">
<?php echo $type?>
</ul>

<div class="page">
	       <div class="pageLeft">
	         <table width="427" border="0" align="left">
	           <tr>
	             <td width="36"><div class="action checkAll">全选</div></td>
	             <td width="36"><div class="action" id="checkBack">反选</div></td>
	             <td width="230">
	                 <div style="float:left" class="action">删除</div> <div  style="float:left; width:100px" id="app-1" class="action">新增分类</div>    
                  </td>
	             <td width="107">&nbsp;</td>
               </tr>
             </table>
	       </div>
</div>

</div>
<script src="/Static/admin/js/type.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$( ".album-box" ).hide();
	$( ".type-list" ).sortable({containment: 'parent',stop:function(event, ui){
		var id = ui.item.next().attr("id");
		var cid = ui.item.attr("id");
		if($.type(id) == 'undefined'){
			var id = ui.item.prev().attr("id");
			var type = '1';
			$.post(baseURL+"/album/paixu",{id:id,cid:cid,type:type},function(){});
		}else{
			var id = ui.item.next().attr("id");
			var type = '+';
			$.post(baseURL+"/album/paixu",{id:id,cid:cid,type:type},function(){});
		}
	} })
    .disableSelection();
	$( ".album-box" ).sortable({containment: 'parent',stop:function(event, ui){
		var id = ui.item.next().attr("id");
		var cid = ui.item.attr("id");
		if($.type(id) == 'undefined'){
			var id = ui.item.prev().attr("id");
			var type = '+';
			$.post(baseURL+"/album/paixu",{id:id,cid:cid,type:type},function(){});
		}else{
			var id = ui.item.next().attr("id");
			var type = '-';
			$.post(baseURL+"/album/paixu",{id:id,cid:cid,type:type},function(){});
		}
	} })
    .disableSelection();
    $(".type-list-dd,.album-list-parent").dblclick(function(){
	    var id = $(this).attr("id");
		var dialog = art.dialog({
		    title:'编辑',
		    lock:true
	    });
        $.ajax({
            url: baseURL+'/album/edit?id='+id,
            success: function (data) {
                 dialog.content(data);
            },
            cache: false
        });
   });
   $(".ss").toggle(
      function(){
		 var ssID = $(this).attr("id");
		 $(this).parent().next(".album-box").show();
	  },
      function(){
         var ssID = $(this).attr("id");
	     $(this).parent().next(".album-box").hide();
   });
});

$("#type").live("submit",function(){
	if($("#name").val() == ''){
		art.dialog({
			content:'请填写分类名称',
			time:3
		 });
		return false;
	}
	var alias = /[\w]/;
	if(!alias.test($("#alias").val())){
		art.dialog({
			content:'分类别名中只能是数组或者字母',
			time:3
		 });
		 return false;
	}
});

$("#change-ico").click(function(){
	var dialog = art.dialog({
		id:'ND1539',
		width:'80%',
		title:'选择图片',
		lock:true
	});
		
	
	$.get(baseURL+"/public/pic_list",function(v){
		 dialog.content(v);
	     var cid = $(".cid").attr("id");
         var aid = $(".aid").attr("id");
         $("#select option").each(function(i,e){
	         if(i==0){
		          cid = $(this).val();
		          $.get(baseURL+"/album/lib?cid="+cid,function(r){

		              var str = '<span style="float:left; line-height:50px; margin-right:30px"><<</span>';
	     	          $.each(r,function(i,e){
			               str+='<p><a href="javascript:album('+e.cid+')">'+e.class_name+'</a></p>';
		              });
		              str+='<span style="line-height:50px;">>></span>';
		              $(".img-right").html(str);
	              },'json');		
	         }
        });
        album();

	

	});
});

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
		$(".img-right").html(str);
	},'json');
});


$(".img").live("click",function(){
	$(".img").each(function(){
		if($(this).attr("class")=="img img-border"){
			$(this).removeClass("img-border");
		}
	});
	$(this).addClass("img-border");		
});

$(".check-img").live("click",function(){
	$(".img").each(function(){
		if($(this).attr("class")=="img img-border"){
			var imgSRC = $(this).children("img").attr("src");
			$("#change-ico").html('<img src="'+imgSRC+'" />');
			$("#ico").val(imgSRC);
		}
	});
	art.dialog.through({id: 'ND1539'}).close();
});

$(".del").live("click",function(){
	var id = $(this).parent().attr("id");
	var del = $(this).parent();
	art.dialog({
    content: '您确定要删除吗？',
    ok: function () {
		$.get(baseURL+"/album/del?id="+id,function(x){
		if(x.code == 1){
			art.dialog({
			    title:'提示',
				content:x.msg,
				time:2
			});
	
			del.remove();
		}else{
			art.dialog({
			    title:'提示',
				content:x.msg,
				time:2
			});
		}
	    },'json');
    	this.close();
        return false;
    },
	lock:true,
    cancelVal: '关闭',
    cancel: true //为true等价于function(){}
});
	
	
});
</script>
<?php require_once('./Realize/Admin/View/Public/footer.php');?>