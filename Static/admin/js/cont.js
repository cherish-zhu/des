// JavaScript Document

$(function(){
	  $(".tab-menu li").each(function(i,e){
			if(i==0) $(this).css({ height:"36px",background:"#FFF"});			  
	        $(this).click(function(){
				  $(".tab-menu li").each(function(u,n){
						if(u!=i) $(this).css({ height:"35px"});
		          });
		          $(".tab-list").each(function(s,y){		
				         if(s==i) $(this).show();				       
				         else $(this).hide();
		           });
				   $(this).css({ height:"36px",background:"#FFF"});
		     });
		     $(".tab-list").each(function(s,y){ if(s==0) $(this).show() });
		});
		
		$(".ui-state-default li").hide();
	    $(".fa-angle-right").toggle(function(){
	         $(this).removeClass("fa-angle-right");
		     $(this).addClass("fa-angle-down");
		     show = $(this).attr("id");
		     $("."+show+">li").show();		
	    },function(){
		     $(this).removeClass("fa-angle-down");
		     $(this).addClass("fa-angle-right");
		     hide = $(this).attr("id");
		     $("."+hide+"  li").hide();
	    });
		
		$(".cate-son").click(function(){
			$(".cate-son").removeClass("check-back");
			$(this).addClass("check-back");
			id = $(this).attr("id");
			id = id.split("-");
			id = id[2];
			$("#cateid").val(id);
		});
	  	
});