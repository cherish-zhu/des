// JavaScript Document
$(function(){
	 
	$("#user_main").hide();
	$(".panel-body").hide();
	function tipsStr(str){
		ret =  '<div class="destroyTips"  style="background-color:#FFF"><table width="360" border="0"><tr><td width="75">&nbsp;</td> <td width="48"><img src="/Static/icon/succeed.png" width="48" height="48" /></td> <td align="left">'+str+'</td></tr></table></div>';
		return ret;
	}
	
	
	var width = $(window).width();
	var height = $(window).height()-86;
	$(".left").height(height);
	var left  = 256;
	if(width > 1096){
		var right = width - left - 25;
		$(".right").width(right);
		$(".mian").width(width);
	}
	$(window).resize(function() { 
         var width = $(window).width();
	     var left  = 256;
	     if(width > 1096){
		     var right = width - left - 25;
		     $(".right").width(right);
			 $(".mian").width(width);
	     }
    })
	
	$(".top li").each(function(i){
		if($(this).attr("id")=="user"){
			return false;
		}
		$(this).on({
			mousemove:function(){
				$(".top li").removeClass("click");
			    $(this).attr("class","click");
			},
			mouseout:function(){
			    $(".top li").removeClass("click");
		    }
		});
	});
	$("#user").on({
		mousemove:function(){
		    $("#user").css("background","#fff");
		    $("#user").css("color","#333");
            $("#user_main").show();
	    },
		mouseout:function(){
			  $("#user_main").hide();
		     $("#user").css("background","#333");
		     $("#user").css("color","#fff");
	    }
	});
	$("#user_main").on({
		mousemove:function(){
	         $("#user_main").show();
             $("#user").css("background","#fff");
	         $("#user").css("color","#333");
         },
		 mouseout:function(){		
		     $("#user_main").hide();
		     $("#user").css("background","#333");
		     $("#user").css("color","#fff");
    }
	});

    $("#editPW").bind("click",function(){
		var dialog = art.dialog({id: 'N3690',title: "修改密码"});
	    $.ajax({
              url: '/admin/user/pw_edit',
              success: function (data) {
                    dialog.content(data);
              },
              cache: false
        }); 
    });
    
    $("#change-img,#change-ico").bind("click",function(){
		var dialog = art.dialog({id: 'N35891',title: "选择图片",	lock:true});
	    $.ajax({
              url: '/admin/album/change_img',
              success: function (data) {
                    dialog.content(data);
              },
              cache: false
        }); 
    });
    
	$("#myEdit").click(function(){
		var dialog = art.dialog({
            width: '90%',
            height: '80%',
            left: '90px',
            top: '90px',
            fixed: true,
            resize: false,
            drag: false,
			lock:true,
			title:"我的资料"
        });
		
		$.ajax({
              url: '/admin/user/size_edit',
              success: function (data) {
                    dialog.content(data);
              },
              cache: false
        });
	});
	$("#userout").bind("click",function(){
		var url= '/admin/Public/logout';
		$.get(url,function(data){
			if(data.status==1){
				location.href = "/admin/Public/login";
			}
		},'json');
	});
	
	$(".list li").each(function(i){
	   if(i>20){
		   $(this).hide();
	   }
	   $(this).mousemove(function(){
			$(".list li").removeClass("left_list");
			$(this).attr("class","left_list");
		});
		$(this).mouseout(function(){
			$(".list li").removeClass("left_list");
		});
		$(this).click(function(){
			$("#list li").attr("id","");
			$(this).attr("id","left_list");
		});

	});
	var start = 0;
	var listCount = $("#list li").size();
    
	$("#list_up").click(function(){
		
		start = start+1;
		end   = start + 5;
		if(end>=listCount){
			start = listCount-6;
		}
		
		$("#list li").each(function(i){

			 if(i<start){
				  $(this).slideUp(500);
			 }
			 if(i==end){
				$(this).slideDown(500);
			 }
		 });
		
	  	
	});
	
		$("#list_down").click(function(){

		start = start-1;
		if(start<=0){
			start = 0;
		}
		end   = start + 5;
		
		$("#list li").each(function(i){

			 if(i==start){
				  $(this).slideDown(500);
			 }
			 
		    if(i>end){
			    $(this).slideUp(500);
		    }
		});
		
	});
	
	
	$("#go_hc").click(function(){		
		$("body").prepend(tipsStr('更新缓存成功！！'));
		setTimeout('$(".destroyTips").remove()',3000);
	});
	
	 $(".checkAll").click(function(){
		 $("input[type='checkbox']").attr("checked","checked");
	 });
	 $("#checkBack").click(function(){
		 $("input[type='checkbox']").each(function(i,n){		 
			 if(n.checked==false){
				 n.checked = true; 
			 }else{
				 n.checked = false;
			 }
		 });
	 });

	

});